<?php
    session_start();
    require_once '../core/Router.php';
    require_once __DIR__ . '/../app/Controller/TaskController.php';
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


    $router->dispatch();
