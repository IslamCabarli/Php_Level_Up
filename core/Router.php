<?php
class Router
{

    public function handle($uri, $method)
    {
        require_once __DIR__ . '/../app/Controller/TaskController.php';
         $task = new TaskController();

            if ( $uri == '/tasks' && $method == 'GET' )
            {

                return $task->index();
            }
            else if ( $uri == '/tasks/create' && $method == 'GET' ){

                return $task->create();
            }
            else if ( $uri == '/tasks' && $method == 'POST' )
            {

                return $task->store();
            }
            else if ( $uri == '/tasks/delete' && $method == 'GET' )
            {
                $id = $_GET['id'];
                require_once __DIR__ . '/../app/Controller/TaskController.php';
                $task = new TaskController();
                return $task->delete($id);
            }
            else if ( $uri =='/tasks/edit' && $method == 'GET' )
            {
                $id = $_GET['id'];

                return $task->edit($id);
            }


            else if ( $uri == '/tasks/update' && $method == 'POST' )
            {
                $id = $_POST['id'];
                $description = $_POST['description'];
                $title = $_POST['title'];
                return $task->update($id,$title,$description);
            }

    }
}