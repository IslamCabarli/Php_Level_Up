<?php
class Csrf
{
    public static function generateToken() : string
    {
        if(!empty($_SESSION['csrf_token']))
        {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function verifyToken() : void
    {
        if (
            !isset($_SESSION['csrf_token']) ||
            !isset($_POST['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
        ) {
            http_response_code(403);
            echo "Invalid CSRF token";
            exit;
        }

    }
}