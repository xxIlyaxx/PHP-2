<?php
namespace App;

use App\Exceptions\ForbiddenException;

class Router
{
    use Singleton;

    public $controller;
    public $action;

    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($uri, PHP_URL_PATH);
        $path = trim($path, '/');

        $parts = explode('/', $path);
        $actionParts = explode('-', array_pop($parts));
        $parts = Helper::array_ucfirst($parts);
        $actionParts = Helper::array_ucfirst($actionParts);

        $actionName = implode($actionParts);
        $controllerName = implode('\\', $parts);

        $this->controller = $controllerName ?: 'Index';
        $this->action = $actionName ?: 'Index';
    }

    public function action()
    {
        $controllerClassName = 'App\Controllers\\' . $this->controller;
        if (!class_exists($controllerClassName)) {
            throw new ForbiddenException('Class ' . $this->controller . ' does not exist');
        }

        $controller = new $controllerClassName();
        $action = 'action' . $this->action;
        if (!method_exists($controller, $action)) {
            throw new ForbiddenException('Method ' . $this->action . ' does not exists');
        }

        $controller->action($action);
    }
}