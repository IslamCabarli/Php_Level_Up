<?php
class Router
{
    public function handle($uri)
    {
            if ( $uri == '/tasks' )
            {
                require_once '../app/Controller/TaskController.php';
                $task = new TaskController();
                return $task->index();
            }

    }
}