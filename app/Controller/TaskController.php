<?php
    namespace App\Controller;
    use App\Model\Task;
    use App\Middleware\AuthMiddleware;
    use Core\Validator;
    use Core\Csrf;
    class TaskController
    {
        public function __construct(private Task $task)
        {
        }
        public function index(): void
        {
            $userId = AuthMiddleware::userId();
            $tasks = $this->task->getTasks($userId);
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
            $this->task->create($userId, $title, $description);
            header('Location:/PHP_Review/Public/tasks');
            exit;
        }

        public function delete($id): void
        {
            Csrf::verifyToken();
            $userId = AuthMiddleware::userId();
            $deleted = $this->task->delete($id, $userId);

            if (!$deleted) {
                abort(403);
            }
            header('Location:/PHP_Review/Public/tasks');
            exit;
        }

        public function edit($id): void
        {
            $userId = AuthMiddleware::userId();
            $task = $this->task->edit($id, $userId);

            if (!$task) {
                abort(403);
            }
            require_once __DIR__ . '/../View/tasks/edit.php';
        }

        public function update($id): void
        {
            Csrf::verifyToken();

            $userId = AuthMiddleware::userId();

            $existingTask = $this->task->edit($id, $userId);

            if (!$existingTask) {
                abort(403);
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

            $updated = $this->task->update(
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