<?php
require_once __DIR__ . '/../Model/Task.php';
class TaskController
{
    public function index(): void
    {
        $userId = AuthMiddleware::userId();
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

        $title = trim($_POST['title']);
        $description = trim($_POST['description']);

        $errors = Validator::validate(
            [
                'title' => $title,
                'description' => $description,
            ],
            [
                'title' => ['required', 'min:4'],
                'description' => ['required', 'min:6'],
            ]
        );

        if (!empty($errors)) {
            require_once __DIR__ . '/../View/tasks/create.php';
            return;
        }

        $userId = AuthMiddleware::userId();
        $task = new Task();
        $task->create($userId, $title, $description);
        header('Location:/PHP_Review/Public/tasks');
        exit;
    }

    public function delete($id): void
    {
        Csrf::verifyToken();
        $userId = AuthMiddleware::userId();
        $task = new Task();
        $deleted = $task->delete($id, $userId);

        if (!$deleted) {
            http_response_code(403);
            require_once __DIR__ . '/../View/Error/403.php';
            exit;
        }
        header('Location:/PHP_Review/Public/tasks');
        exit;
    }

    public function edit($id): void
    {
        $userId = AuthMiddleware::userId();
        $tasks = new Task();
        $task = $tasks->edit($id, $userId);

        if (!$task) {
            http_response_code(403);
            require_once __DIR__ . '/../View/Error/403.php';
            exit;
        }
        require_once __DIR__ . '/../View/tasks/edit.php';
    }

    public function update($id): void
    {
        Csrf::verifyToken();

        $userId = AuthMiddleware::userId();

        $taskModel = new Task();

        $existingTask = $taskModel->edit($id, $userId);

        if (!$existingTask) {
            http_response_code(403);
            require_once __DIR__ . '/../View/Error/403.php';
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        $errors = Validator::validate(
            [
                'title' => $title,
                'description' => $description,
            ],
            [
                'title' => ['required', 'min:4'],
                'description' => ['required', 'min:6'],
            ]
        );

        if (!empty($errors)) {

            $task = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
            ];

            require_once __DIR__ . '/../View/tasks/edit.php';
            return;
        }

        $updated = $taskModel->update(
            $id,
            $title,
            $description,
            $userId
        );

        if (!$updated) {
            http_response_code(500);
            require_once __DIR__ . '/../View/Error/500.php';
            exit;
        }

        header('Location: /PHP_Review/Public/tasks');
        exit;
    }
}