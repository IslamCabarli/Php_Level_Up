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
        $task = new Task();
        $task->delete($id);
        header('Location:/PHP_Review/Public/tasks');
    }

    public function edit($id): void
    {
        $tasks = new Task();
        $task = $tasks->edit($id);
        require_once __DIR__ . '/../View/tasks/edit.php';
    }
    public function update($id): void
    {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $task = new Task();
        $task->update($id,$title, $description);
        header('Location:/PHP_Review/Public/tasks');
    }

}