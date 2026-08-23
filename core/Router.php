<?php
class Router
{

    public function handle($uri, $method)
    {
        require_once __DIR__ . '/../app/Controller/TaskController.php';
        require_once __DIR__ . '/../app/COntroller/AuthController.php';
         $task = new TaskController();
        $user = new AuthController();

        if (str_starts_with($uri, '/tasks') && !isset($_SESSION['user_id'])) {
            header('Location: /PHP_Review/Public/auth/login');
            exit;
        }

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

            else if ( $uri == '/auth/logout' && $method == 'GET' )
            {
                return $user->logout();
            }

            else
            {
                http_response_code(404);
                require_once __DIR__ . '/../app/View/Error/404.php';
                die();
            }

    }
}