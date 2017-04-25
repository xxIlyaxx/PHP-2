<?php
namespace App;

/**
 * Class Router
 *
 * @package App
 */
class Router
{
    public function parse($uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);
        $path = trim($path, '/');

        $parts = explode('/', $path);
        $actionParts = explode('-', array_pop($parts));
        $parts = Helper::array_ucfirst($parts);
        $actionParts = Helper::array_ucfirst($actionParts);

        $actionName = implode($actionParts);
        $controllerName = implode('\\', $parts);

        return [
            'controller' => ($controllerName ?: 'Index'),
            'action' => ($actionName ?: 'Index'),
            'params' => $_GET,
        ];
    }

    public function getController($uri)
    {
        return $this->parse($uri)['controller'];
    }

    public function getAction($uri)
    {
        return $this->parse($uri)['action'];
    }
}