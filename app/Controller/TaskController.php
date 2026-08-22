<?php
require_once __DIR__ . '/../Model/Task.php';
class TaskController
{
    public function index()
    {
        $task = new Task();
        $tasks = $task->getTasks();
        require_once __DIR__ . '/../View/tasks/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../View/tasks/create.php';
    }

    public function store()
    {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $task = new Task();
    $task->create($title, $description);
    header('Location:/PHP_Review/Public/tasks');
    }

    public function delete($id)
    {
        $task = new Task();
        $task->delete($id);
        header('Location:/PHP_Review/Public/tasks');
    }
}