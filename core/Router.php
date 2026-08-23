<?php
class Router
{

    public function handle($uri, $method)
    {
        require_once __DIR__ . '/../app/Controller/TaskController.php';
        require_once __DIR__ . '/../app/COntroller/AuthController.php';
         $task = new TaskController();
        $user = new AuthController();

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

            else if ( $uri == '/session/set' && $method == 'GET' )
            {

                $_SESSION['id'] = 1;
                $_SESSION['name'] = 'Namiq';

            }

            else if ( $uri == '/session' && $method == 'GET' )
            {
                $id = $_SESSION['id'];
                $name = $_SESSION['name'];
                echo $name . $id;
            }

            else if ( $uri == '/session/destroy' && $method == 'GET' )
            {
                session_destroy();
            }

            else if ( $uri == '/auth/register' && $method == 'GET' )
            {
                require_once __DIR__ . '/../app/View/auth/register.php';
            }
            else if ( $uri == '/auth/register' && $method == 'POST' )
            {
                return $user->register();
            }
            else if ( $uri == '/auth/login' && $method == 'GET' )
            {
                require_once __DIR__ . '/../app/View/auth/login.php';
            }
            else if ( $uri == '/auth/login' && $method == 'POST' )
            {
                return $user->login();
            }

            else
            {
                http_response_code(404);
                require_once __DIR__ . '/../app/View/Error/404.php';
                die();
            }

    }
}