<?php

namespace App;

use App\Exceptions\ForbiddenException;

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
        if (!$this->access($name)) {
            $this->forbiddenError();
        }
        $this->$name();
    }

    /**
     * Отправляет страницу c сообщением об ошибке,
     * если не найдена запись в базе данных
     */
    public function notFoundError()
    {
        header('HTTP/1.1 404 Not Found', 404);
        $this->view->display(__DIR__ . '/../templates/errors/not_found.php');
        exit();
    }

    /**
     * Отправляет страницу c сообщением об ошибке,
     * если запрошен некорректный путь
     */
    public function forbiddenError()
    {
        header('HTTP/1.1 403 Forbidden', 403);
        $this->view->display(__DIR__ . '/../templates/errors/forbidden.php');
        exit();
    }

    /**
     * Отправляет страницу c сообщением об ошибке,
     * если была ошибка в базе данных
     */
    public function dbError()
    {
        header('HTTP/1.1 500 Internal Server Error', 500);
        $this->view->display(__DIR__ . '/../templates/errors/db.php');
        exit();
    }
}