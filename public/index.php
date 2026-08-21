<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$uri=  str_replace("/PHP_Review/Public", '', $uri);
require_once '../core/Router.php';
$router = new Router();
$router->handle($uri);

var_dump($uri);