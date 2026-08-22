<?php
require_once  __DIR__ . "/../../core/Database.php";
class Task
{

    public $pdo ;
    public function __construct()
    {
        $db = new Database();

        $this->pdo = $db->getPDO();
    }

    public function getTasks()
    {
        $task = $this->pdo->prepare("Select * FROM tasks");
        $task->execute();
        return $task->fetchAll(PDO::FETCH_ASSOC);




    }
    public function create($title, $description)
    {
        $task = $this->pdo->prepare("INSERT INTO tasks (title, description) VALUES (:title, :description)");
        $task->bindParam(':title', $title);
        $task->bindParam(':description', $description);
        $task->execute();
    }
}