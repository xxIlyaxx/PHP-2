<?php

require __DIR__ . '/autoload.php';

use App\Helper;

//Реализация ЧПУ
//путь вида xxx/yyy/aaa-bbb
//преобразуется в
//controller = Xxx\Yyy
//action = AaaBbb
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);
$path = trim($path, '/');

$parts = explode('/', $path);
$actionParts = explode('-', array_pop($parts));
$parts = Helper::array_ucfirst($parts);
$actionParts = Helper::array_ucfirst($actionParts);

$action = implode($actionParts);
$controllerName = implode('\\', $parts);

$controllerClassName = 'App\Controllers\\' . ($controllerName ?: 'Index');
if (!class_exists($controllerClassName)) {
    header('HTTP/1.1 403 Forbidden', 403);
    include __DIR__ . '/templates/forbidden.php';
    exit();
}

$controller = new $controllerClassName();
$controller->action($action ?: 'Index');
