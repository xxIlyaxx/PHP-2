<?php

namespace App;

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
     * @param string $action
     * @return bool
     */
    protected function access(string $action)
    {
        return method_exists($this, $action);
    }

    /**
     * Получает имя экшена, проверяет на валидацию
     * и выполняет его
     *
     * @param string $name
     */
    public function action(string $name)
    {
        $name = 'action' . $name;
        if (false === $this->access($name)) {
            static::forbiddenError();
        }
        $this->$name();
    }

    /**
     * Отправляет страницу c сообщением об ошибке,
     * если не найдена запись в базе данных
     */
    public static function notFoundError()
    {
        $view = new View();
        header('HTTP/1.1 404 Not Found', 404);
        $view->display(__DIR__ . '/../templates/errors/not_found.php');
        exit();
    }

    /**
     * Отправляет страницу c сообщением об ошибке,
     * если запрошен некорректный путь
     */
    public static function forbiddenError()
    {
        $view = new View();
        header('HTTP/1.1 403 Forbidden', 403);
        $view->display(__DIR__ . '/../templates/errors/forbidden.php');
        exit();
    }

    /**
     * Отправляет страницу c сообщением об ошибке,
     * если была ошибка в базе данных
     */
    public static function dbError()
    {
        $view = new View();
        header('HTTP/1.1 500 Internal Server Error', 500);
        $view->display(__DIR__ . '/../templates/errors/db.php');
        exit();
    }
}