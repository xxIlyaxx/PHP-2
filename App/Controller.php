<?php

namespace App;

use App\Exceptions\ForbiddenException;
use App\Controllers\ErrorController;

/**
 * Class Controller
 * Базовый класс контроллера
 *
 * @package App
 */
abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Метод - валидатор
     *
     * @param $name
     * @return bool
     */
    protected function access($name)
    {
        return method_exists($this, $name);
    }

    /**
     * Получает имя экшена, проверяет на валидацию
     * и выполняет его
     *
     * @param string $name
     * @throws ForbiddenException
     */
    public function action(string $name)
    {
        $method = 'action' . $name;
        if (!$this->access($method)) {
            (new ErrorController())->action('ForbiddenError');
        }
        $this->$method();
    }
}