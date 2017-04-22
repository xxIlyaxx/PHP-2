<?php

require __DIR__ . '/autoload.php';
require __DIR__ . '/vendor/autoload.php';

use App\Router;
use App\View;

$router = Router::getInstance();

if (!class_exists($router->controllerClassName)) {
    $view = new View();
    header('HTTP/1.1 403 Forbidden', 403);
    $view->display(__DIR__ . '/../templates/errors/forbidden.php');
    exit();
}

$controller = new $router->controllerClassName();

try {
    $controller->action($router->actionMethodName);
} catch (\App\Exceptions\DbException $e) {
    $controller->dbError();
} catch (\App\Exceptions\NotFoundException $e) {
    $controller->notFoundError();
}