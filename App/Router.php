<?php
namespace App;

/**
 * Class Router
 *
 * @package App
 *
 * @property string controller
 * @property string action
 * @property string controllerClassName
 * @property string actionMethodName
 */
class Router
{
    use Singleton;
    use GetSet;

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
        $this->controllerClassName = 'App\Controllers\\' . $this->controller;
        $this->actionMethodName = 'action' . $this->action;
    }
}