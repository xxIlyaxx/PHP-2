<?php

require __DIR__ . '/autoload.php';
require __DIR__ . '/vendor/autoload.php';

use App\Router;
use App\Controllers\ErrorController;

$router = new Router();
$parsedUri = $router->parse($_SERVER['REQUEST_URI']);

$controllerClassName = 'App\Controllers\\' . $parsedUri['controller'];
if (!class_exists($controllerClassName)) {
    (new ErrorController())->action('ForbiddenError');
}

$controller = new $controllerClassName();

try {
    $controller->action($parsedUri['action']);
} catch (\App\Exceptions\DbException $e) {
    (new ErrorController())->action('DbError');
} catch (\App\Exceptions\NotFoundException $e) {
    (new ErrorController())->action('NotFoundError');
}