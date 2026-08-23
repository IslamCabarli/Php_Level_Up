<?php
    require_once __DIR__ . '/../Model/User.php';
    class AuthController
    {

        public function register()
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = new User();
            $user->register($name, $email, $password);
            header('Location:/PHP_Review/Public/tasks');

        }

        public function login()
        {

        }

        public function logout()
        {

        }
    }