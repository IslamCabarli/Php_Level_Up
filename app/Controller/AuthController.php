<?php
    require_once __DIR__ . '/../Model/User.php';
    class AuthController
    {

        public function register(): void
        {
          Csrf::verifyToken();

            $errors = [];

            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if($error = Validator::required($name, 'Name'))
            {
                $errors[] = $error;
            }
            else if ( $error = Validator::minLength($name, 3, 'Name')) {
                $errors[] = $error;
            }
            if ($error = Validator::required($email, 'Email'))
            {
                $errors[] = $error;
            }
            else if ( $error = Validator::email($email))
            {
                $errors[] = $error;
            }

            if ($error = Validator::required($password, 'Password'))
            {
                $errors[] = $error;
            }
            else if ( $error = Validator::minLength($password, 8, 'Password'))
            {
                $errors[] = $error;
            }

            if(!empty($errors)){
                require_once __DIR__ . '/../View/auth/register.php';
                return;
            }
            $user = new User();

            $existingUser = $user->findByEmail($email);

            if($existingUser){
                $errors[] = "This email is already registered";
                require_once __DIR__ . '/../View/auth/register.php';
                return;
            }
                $user->register($name, $email, $password);
                header('Location:/PHP_Review/Public/auth/login');
                exit;

        }

        public function showRegister(): void
        {
            require_once __DIR__ . '/../View/auth/register.php';
        }

        public function showLogin(): void
        {
            require_once __DIR__ . '/../View/auth/login.php';
        }

        public function login(): void
        {
           Csrf::verifyToken();
            $errors = [];
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($error = Validator::required($email, 'Email')) {
                $errors[] = $error;
            }else if ($error = Validator::email($email)) {
                $errors[] = $error;
            }
            if ($error = Validator::required($password, 'Password'))
            {
                $errors[] = $error;
            }

            if (!empty($errors)) {
                require_once __DIR__ . '/../View/auth/login.php';
                return;
            }

            $user = new User();
            $existingUser = $user->findByEmail($email);

            if (!$existingUser || !password_verify($password, $existingUser->password))
            {
                $errors[] = "Invalid email or password";
                require_once __DIR__ . '/../View/auth/login.php';
                return;
            }

            session_regenerate_id(true);

            $_SESSION['user_id'] = $existingUser['id'];

            header('Location: /PHP_Review/Public/tasks');
            exit;



        }

        public function logout()
        {

            unset($_SESSION['user_id']);
            header('Location:/PHP_Review/Public/tasks');
            exit;
        }
    }