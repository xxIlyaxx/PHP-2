<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Article;

/**
 * Class Admin
 * Контроллер админки
 *
 * @package App\Controllers
 */
class Admin extends Controller
{
    /**
     * Главная страница
     */
    protected function actionIndex()
    {
        $this->view->articles = Article::findAll();
        $this->view->display(__DIR__ . '/../../templates/admin/index.php');
    }

    /**
     * Создание статьи
     */
    protected function actionAddArticle()
    {
        $title = $_POST['title'] ?? null;
        $lead = $_POST['lead'] ?? null;

        if (null === $title || null === $lead) {

            $this->view->action = '/admin/add-article';
            $this->view->pageTitle = 'Новая статья';
            $this->view->authorName = null;

            $this->view->display(__DIR__ . '/../../templates/admin/edit_article.php');
            exit();
        }

        $article = new Article();
        $article->title = $title;
        $article->lead = $lead;
        if (true === $article->save()) {
            header('Location: /admin/index');
        }
    }

    /**
     * Удаление статьи
     */
    protected function actionDeleteArticle()
    {
        $article = Article::findById($_GET['id'] ?? null);
        if (true === $article->delete()) {
            header('Location: /admin/index');
        }
    }

    /**
     * Редактирование статьи
     */
    protected function actionUpdateArticle()
    {
        if (isset($_GET['id'])) {

            $this->view->id = (int)$_GET['id'];

            $article = Article::findById($this->view->id);
            $this->view->title = $article->title;
            $this->view->lead = $article->lead;
            $this->view->authorName = (null !== $article->author) ? 'Автор: ' . $article->author->name : 'Неизвестный автор';

            $this->view->action = '/admin/update-article';
            $this->view->pageTitle = 'Редактирование статьи';

            $this->view->display(__DIR__ . '/../../templates/admin/edit_article.php');
            exit();
        }

        $article = Article::findById($_POST['id'] ?? null);
        $article->title = $_POST['title'] ?? null;
        $article->lead = $_POST['lead'] ?? null;

        if (true === $article->save()) {
            header('Location: /admin/index');
        }
    }
}
