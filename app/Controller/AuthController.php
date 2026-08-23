<?php
    require_once __DIR__ . '/../Model/User.php';
    class AuthController
    {

        public function register()
        {
            $errors = [];
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            if($name == "")
            {
                $errors[] =("Name cannot be empty");
            }
            else if(strlen($name) <3) {
                $errors[] = ("Name cannot be less than 3");
            }
            if ($email == "")
            {
                $errors[] =("Email cannot be empty");
            }
            else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
            {
                $errors[] =("Wrong email format");
            }

            if ($password == "")
            {
                $errors[] =("Password cannot be empty");
            }


            else if (strlen($password) <8 )
            {
                $errors[] =("Password cannot be less than 8");
            }

            $user = new User();
            $existingUser = $user->findByEmail($email);
            if($existingUser){
                $errors[] = "This email is already registered";
            }
            if(!empty($errors)){
                require_once __DIR__ . '/../View/auth/register.php';
            }
            else{


                $user->register($name, $email, $password);
                header('Location:/PHP_Review/Public/tasks');
            }
        }

        public function login()
        {

        }

        public function logout()
        {

        }
    }