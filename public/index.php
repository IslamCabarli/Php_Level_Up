<?php
    session_start();
    if (empty($_SESSION['csrf_token']) )
    {
        try {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } catch (\Random\RandomException $e) {
            echo $e->getMessage();
        }
    }
    require_once '../core/Router.php';
    require_once __DIR__ . '/../app/Controller/TaskController.php';
    require_once __DIR__ . '/../app/Controller/AuthController.php';

    $router = new Router();
    $router->get('/', function() {
        echo "Welcome to the default index route!";
    });
    $router->get('/tasks', [TaskController::class, 'index']);
    $router->get('/tasks/create', [TaskController::class, 'create']);
    $router->post('/tasks', [TaskController::class, 'store']);
    $router->get('/tasks/edit/{id}',[TaskController::class, 'edit']);
    $router->post('/tasks/update/{id}', [TaskController::class, 'update']);
    $router->get('/tasks/delete/{id}', [TaskController::class, 'delete']);
    $router->get('/auth/login', [AuthController::class, 'showLogin']);
    $router->post('/auth/login', [AuthController::class, 'login']);
    $router->get('/auth/register', [AuthController::class, 'showRegister']);
    $router->post('/auth/register', [AuthController::class, 'register']);
    $router->get('/auth/logout', [AuthController::class, 'logout']);


    $router->dispatch();
