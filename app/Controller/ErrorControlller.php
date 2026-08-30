<?php
    class ErrorControlller
    {
        public function show(int $code): void
        {
            http_response_code($code);
            require_once __DIR__ . "/../View/Error/{$code}.php";
        }
    }