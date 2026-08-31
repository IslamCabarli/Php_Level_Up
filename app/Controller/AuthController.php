<?php
    require_once __DIR__ . '/../Model/User.php';
    class AuthController
    {

        public function register(): void
        {
          Csrf::verifyToken();
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'password' => $_POST['password'] ?? '',
            ];

            $errors = Validator::validate(
               $data,
                [
                    'name' => ['required', 'min:3'],
                    'email' => ['required', 'email'],
                    'password' => ['required', 'min:8'],

                ]
            );
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

            $data = [
                'email' => trim($_POST['email'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
            ];

            $errors = Validator::validate(
                $data,
                [
                    'email' => ['required', 'email'],
                    'password' => ['required'],

                ]
            );
            if (!empty($errors)) {
                require_once __DIR__ . '/../View/auth/login.php';
                return;
            }

            $user = new User();
            $existingUser = $user->findByEmail($data['email']);

            if (!$existingUser || !password_verify($data['password'], $existingUser['password']))
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

        public function logout(): void
        {
            Csrf::verifyToken();
            unset($_SESSION['user_id']);
            session_regenerate_id(true);
            header('Location:/PHP_Review/Public/tasks');
            exit;
        }
    }