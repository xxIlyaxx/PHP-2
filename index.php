<?php

require __DIR__ . '/autoload.php';
require __DIR__ . '/vendor/autoload.php';

use App\Controller;
use App\Router;

try {
    $router = Router::getInstance();
    $router->action();
} catch (\App\Exceptions\ForbiddenException $e) {
    Controller::forbiddenError();
} catch (\App\Exceptions\DbException $e) {
    Controller::dbError();
} catch (\App\Exceptions\NotFoundException $e) {
    Controller::notFoundError();
}