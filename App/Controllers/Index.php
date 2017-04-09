<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;

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
        $this->view->article = Article::findById($_GET['id'] ?? null);
        $this->view->display(__DIR__ . '/../../templates/article.php');
    }
}
