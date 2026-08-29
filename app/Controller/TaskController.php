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

    public function create() :void
    {
        require_once __DIR__ . '/../View/tasks/create.php';
    }

    public function store() :void
    {
        if(!isset($_SESSION['csrf_token']) ||
            !isset($_POST['csrf_token'])  ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            http_response_code(403);
            echo "Invalid CSRF token";
            exit;
        }

        $errors = [];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        if (empty($title))
        {
            http_response_code(400);
            array_push($errors, "Please enter title");
        }
        if (empty($description))
        {
            http_response_code(400);
            array_push($errors,     "Please enter description");

        }

        if (strlen($title)<=3)
        {
            http_response_code(400);
            array_push($errors, "Title must be up 3 characters");
        }
        if (strlen($description)<=5)
        {
            http_response_code(400);
            array_push($errors, "Description must be up 5 characters");

        }
        if (!empty($errors)){
            require_once __DIR__ . '/../View/tasks/create.php';
        }
        else
        {
            $userId = $_SESSION['user_id'];
            $task = new Task();
            $task->create($userId, $title, $description);
            header('Location:/PHP_Review/Public/tasks');
        }
    }

    public function delete($id): void
    {
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

        if (!$task)
        {
            http_response_code(403);
            echo "You are not allowed to edit this task";
            exit;
        }
        require_once __DIR__ . '/../View/tasks/edit.php';
    }
    public function update($id): void
    {
        $userId = $_SESSION['user_id'];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $task = new Task();
        $updated = $task->update($id,$title, $description, $userId);

        if (!$updated)
        {
            http_response_code(403);
            echo "You are not allowed to update this task";
            exit;
        }

        header('Location:/PHP_Review/Public/tasks');
        exit;
    }

}