<?php
    session_start();
    require_once '../core/Router.php';
    $router = new Router();
    $router->get('/', function() {
        echo "Welcome to the default index route!";
    });
    $router->get('/tasks', function() {
        require_once __DIR__ . "../View/tasks.php";
    });
    $router->post('/tasks/create', function() {

    });


    $router->dispatch();
