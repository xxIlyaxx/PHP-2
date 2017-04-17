<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;
use App\Exceptions\NotFoundException;
use App\Logger;

/**
 * Class Index
 * Контроллер блока новостей
 *
 * @package App\Controllers
 */
class Index extends Controller
{
    /**
     * Главная страница
     */
    protected function actionIndex()
    {
        $this->view->articles = Article::findLast();
        $this->view->display(__DIR__ . '/../../templates/index.php');
    }

    /**
     * Страница с одной статьей
     */
    protected function actionOne()
    {
        $article = Article::findById($_GET['id'] ?? null);
        if (false === $article) {
            $e = new NotFoundException('Not found record with given id', 2);
            Logger::getInstance()->log($e);
            throw $e;
        }
        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../../templates/article.php');
    }
}
