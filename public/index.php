<?php
    session_start();
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $uri=  str_replace("/PHP_Review/Public", '', $uri);
    $method = $_SERVER['REQUEST_METHOD'];
    require_once '../core/Router.php';
    $router = new Router();
    $router->handle($uri, $method);
