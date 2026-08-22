<?php
require_once __DIR__ . '/../Model/Task.php';
class TaskController
{
    public function index(): void
    {
        $task = new Task();
        $tasks = $task->getTasks();
        require_once __DIR__ . '/../View/tasks/index.php';

    }

    public function create() :void
    {
        require_once __DIR__ . '/../View/tasks/create.php';
    }

    public function store() :void
    {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    if (empty($title) ||  empty($description)){
        http_response_code(400);
        $error = "Please enter title and description";
        require_once __DIR__ . '/../View/tasks/create.php';
    }

    else if (strlen($title)<=3 || strlen($description)<=5)
    {
        http_response_code(400);
        $error = "Title must be up 3 and Description mus be up to 5 characters";
        require_once __DIR__ . "/../View/tasks/create.php";
    }
    else
    {
        $task = new Task();
        $task->create($title, $description);
        header('Location:/PHP_Review/Public/tasks');
    }


    }

    public function delete($id)
    {
        $task = new Task();
        $task->delete($id);
        header('Location:/PHP_Review/Public/tasks');
    }

    public function edit($id)
    {
        $tasks = new Task();
        $task = $tasks->edit($id);
        require_once __DIR__ . '/../View/tasks/edit.php';
    }
    public function update($id, $title, $description)
    {
        $task = new Task();
        $task->update($id, $title, $description);
        header('Location:/PHP_Review/Public/tasks');
    }

}