<?php
class Router
{
    public function handle($uri, $method)
    {
            if ( $uri == '/tasks' && $method == 'GET' )
            {
                require_once __DIR__ . '/../app/Controller/TaskController.php';
                $task = new TaskController();
                return $task->index();
            }
            else if ( $uri == '/tasks/create' && $method == 'GET' ){
                require_once __DIR__ . '/../app/Controller/TaskController.php';
                $task = new TaskController();
                return $task->create();
            }
            else if ( $uri == '/tasks' && $method == 'POST' )
            {
                require_once __DIR__ . '/../app/Controller/TaskController.php';
                $task = new TaskController();
                return $task->store();
            }

    }
}