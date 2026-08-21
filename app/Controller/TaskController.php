<?php
require_once  '../app/Model/Task.php';
class TaskController
{
    public function index()
    {
        $task = new Task();
        $tasks= $task->getTasks();
        require_once '../app/View/tasks/index.php' ;
    }
}
