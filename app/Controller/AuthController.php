<?php
    require_once __DIR__ . '/../Model/User.php';
    class AuthController
    {

        public function register(): void
        {
          Csrf::verifyToken();

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

        public function showRegister(): void
        {
            require_once __DIR__ . '/../View/auth/register.php';
        }

        public function showLogin(): void
        {
            require_once __DIR__ . '/../View/auth/login.php';
        }

        public function login()
        {
           Csrf::verifyToken();
            $errors = [];
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $user = new User();
            $existingUser = $user->findByEmail($email);
            if($existingUser){
                if(password_verify($password, $existingUser['password'])){
                    $_SESSION['user_id'] = $existingUser['id'];
                    header('Location:/PHP_Review/Public/tasks');
                    exit;
                }
                else {
                    $errors[] = "Invalid email or password";
                }

            }
            else{
                $errors[] = "Invalid email or password";
            }
            if(!empty($errors)){
                require_once __DIR__ . '/../View/auth/login.php';
            }
        }

        public function logout()
        {

            unset($_SESSION['user_id']);
            header('Location:/PHP_Review/Public/tasks');
            exit;
        }
    }