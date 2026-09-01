<?php
class Database
{
    private $pdo;
    private $host = 'localhost';
    private $dbname = 'php_review';
    private $username = 'root';
    private $password = '1234';
    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=$this->host;dbname=$this->dbname",
            $this->username,
            $this->password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}