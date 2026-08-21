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
        $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}