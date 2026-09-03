<?php
    require_once __DIR__ . '/../vendor/autoload.php';
session_start();

    use Core\Router;
    use Core\Csrf;
    use App\Controller\TaskController;
    use App\Controller\AuthController;
require_once '../core/helpers.php';


Csrf::generateToken();

set_exception_handler(function (Throwable $exception): void {

    error_log($exception->getMessage());

    http_response_code(500);

    require_once __DIR__ . '/../app/View/Error/500.php';

    exit;
});

$router = new Router();
$router->get('/', function () {
    echo "Welcome to the default index route!";
});
$router->get('/tasks', [TaskController::class, 'index'], true);
$router->get('/tasks/create', [TaskController::class, 'create'], true);
$router->post('/tasks', [TaskController::class, 'store'], true);
$router->get('/tasks/edit/{id}', [TaskController::class, 'edit'], true);
$router->post('/tasks/update/{id}', [TaskController::class, 'update'], true);
$router->post('/tasks/delete/{id}', [TaskController::class, 'delete'], true);

$router->get('/auth/login', [AuthController::class, 'showLogin']);
$router->post('/auth/login', [AuthController::class, 'login']);
$router->get('/auth/register', [AuthController::class, 'showRegister']);
$router->post('/auth/register', [AuthController::class, 'register']);
$router->post('/auth/logout', [AuthController::class, 'logout'], true);

$router->dispatch();
