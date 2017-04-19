<?php

use App\View;

return [
    'content' => function ($article) {
        $view = new View();
        $view->article = $article;
        return $view->render(__DIR__ . '/templates/content.php');
    },

    'actions' => function ($article) {
        $view = new View();
        $view->article = $article;
        return $view->render(__DIR__ . '/templates/actions.php');
    },
];
