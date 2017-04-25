<?php

require __DIR__ . '/autoload.php';
require __DIR__ . '/vendor/autoload.php';

use App\Router;
use App\Controllers\Errors;

$router = Router::getInstance();

if (!class_exists($router->controllerClassName)) {
    (new Errors())->action('ForbiddenError');
}

$controller = new $router->controllerClassName();

try {
    $controller->action($router->action);
} catch (\App\Exceptions\DbException $e) {
    (new Errors())->action('DbError');
} catch (\App\Exceptions\NotFoundException $e) {
    (new Errors())->action('NotFoundError');
}