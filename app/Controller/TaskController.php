<?php
require_once __DIR__ . '/../Model/Task.php';
class TaskController
{
    public function index(): void
    {
        $userId = $_SESSION['user_id'];
        $task = new Task();
        $tasks = $task->getTasks($userId);
        require_once __DIR__ . '/../View/tasks/index.php';

    }

    public function create(): void
    {
        require_once __DIR__ . '/../View/tasks/create.php';
    }

    public function store(): void
    {
        Csrf::verifyToken();

        $errors = [];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        if ($error = Validator::required($title, 'Title')) {
            $errors[] = $error;
        } elseif ($error = Validator::minLength($title, 4, 'Title')) {
            $errors[] = $error;
        }

        if ($error = Validator::required($description, 'Description')) {
            $errors[] = $error;
        } elseif ($error = Validator::minLength($description, 8, 'Description')) {
            $errors[] = $error;
        }
        if (!empty($errors)) {
            require_once __DIR__ . '/../View/tasks/create.php';
            return;
        }

        $userId = $_SESSION['user_id'];
        $task = new Task();
        $task->create($userId, $title, $description);
        header('Location:/PHP_Review/Public/tasks');
        exit;
    }

    public function delete($id): void
    {
        Csrf::verifyToken();
        $userId = $_SESSION['user_id'];
        $task = new Task();
        $deleted = $task->delete($id, $userId);

        if (!$deleted) {
            http_response_code(403);
            echo "You are not allowed to delete this task";
            exit;
        }
        header('Location:/PHP_Review/Public/tasks');
        exit;
    }

    public function edit($id): void
    {
        $userId = $_SESSION['user_id'];
        $tasks = new Task();
        $task = $tasks->edit($id, $userId);

        if (!$task) {
            http_response_code(403);
            echo "You are not allowed to edit this task";
            exit;
        }
        require_once __DIR__ . '/../View/tasks/edit.php';
    }

    public function update($id): void
    {
        Csrf::verifyToken();

        $errors = [];

        $title = trim($_POST['title']);
        $description = trim($_POST['description']);

        if ($error = Validator::required($title, 'Title')) {
            $errors[] = $error;
        } else if ($error = Validator::minLength($title, 4, 'Title')) {
            $errors[] = $error;
        }

        if ($error = Validator::required($description, 'Description')) {
            $errors[] = $error;
        } else if ($error = Validator::minLength($description, 8, 'Description')) {
            $errors[] = $error;
        }

        if (!empty($errors)) {
            $taskModel = new Task();
            $task = $taskModel->edit($id, $_SESSION['user_id']);
            if (!$task) {
                http_response_code(403);
                echo "You are not allowed to update this task";
                exit;
            }
            require_once __DIR__ . '/../View/tasks/edit.php';
            return;
        }
        $userId = $_SESSION['user_id'];

        $task = new Task();

        $updated = $task->update(
            $id,
            $title,
            $description,
            $userId
        );
        if (!$updated) {
            http_response_code(500);
            echo "Failed to update task";
            exit;
        }

        header('Location: /PHP_Review/Public/tasks');
        exit;



    }
}