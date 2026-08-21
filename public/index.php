<?php
$uri = $_SERVER['REQUEST_URI'];
require_once '../core/Router.php';
$router = new Router();
$router->handle($uri);

