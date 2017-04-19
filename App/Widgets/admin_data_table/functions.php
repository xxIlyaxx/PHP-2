<?php

use App\View;
use App\Models\Article;

return [
    function (Article $article) {
        return $article->id;
    },

    function (Article $article) {
        return $article->title;
    },

    function (Article $article) {
        return $article->lead;
    },

    function (Article $article) {
        return (null !== $article->author) ? 'Автор: ' . $article->author->name : 'Неизвестный автор';
    },
];
