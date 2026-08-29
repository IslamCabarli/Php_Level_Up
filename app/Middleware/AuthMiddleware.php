<?php

    namespace AuthMiddleware;
    class AuthMiddleware
    {
        public static function handle(): void
        {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /PHP_Review/Public/auth/login/');
                exit;
            }
        }
    }