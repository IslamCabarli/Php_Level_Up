<?php
require_once  __DIR__ . "/../../core/Database.php";
class Task
{
    public $pdo;
    public function __construct()
    {
        $db = new Database();

        $this->pdo = $db->getPDO();
    }

    public function getTasks($userId): array
    {
        $task = $this->pdo->prepare(
            "SELECT * FROM tasks WHERE user_id = :user_id"
        );

        $task->bindParam(':user_id', $userId);
        $task->execute();
        return $task->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($user_Id, $title, $description): void
    {
        $task = $this->pdo->prepare("INSERT INTO tasks (user_id, title, description) VALUES (:user_id, :title, :description)");
        $task->bindParam(':user_id', $user_Id);
        $task->bindParam(':title', $title);
        $task->bindParam(':description', $description);
        $task->execute();
    }

    public function delete($id): void
    {
        $task = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $task->bindParam(':id', $id);
        $task->execute();
    }
    public function edit($id, $userId)
    {
        $task = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id and user_id = :user_id");
        $task->bindParam(':id', $id);
        $task->bindParam(':user_id', $userId);
        $task->execute();
        return $task->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $description): void
    {
        $task = $this->pdo->prepare('UPDATE tasks SET title = :title,description = :description WHERE id = :id ');
        $task->bindParam(':id', $id);
        $task->bindParam(':title', $title);
        $task->bindParam(':description', $description);
        $task->execute();
    }
}