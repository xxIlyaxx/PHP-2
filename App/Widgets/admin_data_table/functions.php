<?php

return [
    'content' => function ($article) {
        ob_start();
        include __DIR__ . '/templates/content.php';
        return ob_get_clean();
    },

    'actions' => function ($article) {
        ob_start();
        include __DIR__ . '/templates/actions.php';
        return ob_get_clean();
    },
];
