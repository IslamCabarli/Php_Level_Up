<?php
    session_start();
    require_once '../core/Router.php';
    require_once __DIR__ . '/../app/Controller/TaskController.php';
    $router = new Router();
    $router->get('/', function() {
        echo "Welcome to the default index route!";
    });
    $router->get('/tasks', [TaskController::class, 'index']);
    $router->post('/tasks/create', [TaskController::class, 'create']);


    $router->dispatch();
