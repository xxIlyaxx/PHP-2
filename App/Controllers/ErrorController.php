<?php
/**
 * Created by PhpStorm.
 * User: iliac
 * Date: 25-Apr-17
 * Time: 20:24
 */

namespace App\Controllers;

use App\Controller;

/**
 * Class ErrorController
 * @package App\Controllers
 */
class ErrorController extends Controller
{
    /**
     * Отправляет страницу c сообщением об ошибке,
     * если не найдена запись в базе данных
     */
    public function actionNotFoundError()
    {
        header('HTTP/1.1 404 Not Found', 404);
        $this->view->display(__DIR__ . '/../../templates/errors/not_found.php');
        exit();
    }

    /**
     * Отправляет страницу c сообщением об ошибке,
     * если запрошен некорректный путь
     */
    public function actionForbiddenError()
    {
        header('HTTP/1.1 403 Forbidden', 403);
        $this->view->display(__DIR__ . '/../../templates/errors/forbidden.php');
        exit();
    }

    /**
     * Отправляет страницу c сообщением об ошибке,
     * если была ошибка в базе данных
     */
    public function actionDbError()
    {
        header('HTTP/1.1 500 Internal Server Error', 500);
        $this->view->display(__DIR__ . '/../../templates/errors/db.php');
        exit();
    }
}