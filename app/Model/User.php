<?php
    require_once  __DIR__ . "/../../core/Database.php";
    class User
    {
        public $pdo;

        public function __construct()
        {
            $db = new Database();
            $this->pdo = $db->getPDO();
        }
        public function register($name, $email, $password)
            {
                $user = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
                $password = password_hash($password, PASSWORD_DEFAULT);
                $user->bindParam(':name', $name);
                $user->bindParam(':email', $email);
                $user->bindParam(':password', $password);
                $user->execute();
            }


        public function findByEmail()
        {

        }

    }