<?php

use App\View;

return [
    function ($article) {
        ob_start();
        include __DIR__ . '/templates/content.php';
        return ob_get_clean();
    },

    function ($article) {
        ob_start();
        include __DIR__ . '/templates/actions.php';
        return ob_get_clean();
    },
];
