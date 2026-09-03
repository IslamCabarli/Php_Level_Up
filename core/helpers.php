<?php
    namespace Core;
    function abort(int $code): never
    {
        http_response_code($code);

        $view = __DIR__ . "/../app/View/Error/{$code}.php";

        if (file_exists($view)) {
            require_once $view;
        } else {
            echo "<h1>{$code} - Error</h1>";
        }

        exit;
    }