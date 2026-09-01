<?php
require_once  __DIR__ . "/../../core/Database.php";
class Task
{
    private PDO $pdo;
    public function __construct()
    {
        $db = new Database();

        $this->pdo = $db->getPDO();
    }

    public function getTasks(int $userId): array
    {
        try {
            $task = $this->pdo->prepare(
                "SELECT * FROM tasks WHERE user_id = :user_id"
            );


            $task->execute([
                ':user_id' => $userId
            ]);
            return $task->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error fetching tasks: ' . $e->getMessage());

            throw new Exception(
                'Failed to fetch tasks. Please try again later.',
                0,
                $e
            );
        }
    }
    public function create(int $userId, string $title, string $description): void
    {
        $task = $this->pdo->prepare("INSERT INTO tasks (user_id, title, description) VALUES (:user_id, :title, :description)");
        $task->execute([
            ':user_id' => $userId,
            ':title' => $title,
            ':description' => $description
        ]);
    }

    public function delete(int $id, int $userId): bool
    {
        $task = $this->pdo->prepare(
            "DELETE FROM tasks
         WHERE id = :id
         AND user_id = :user_id"
        );

        $task->execute([
            ':id' => $id,
            ':user_id' => $userId
        ]);

        return $task->rowCount() > 0;
    }
    public function edit(int $id, int $userId): ?array
    {
        $task = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id and user_id = :user_id");
        $task->execute([
            ':id' => $id,
            ':user_id' => $userId
        ]);
        $result = $task->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function update(int $id, string $title, string $description, int $userId): bool
    {
        $task = $this->pdo->prepare('UPDATE tasks SET title = :title,description = :description WHERE id = :id and user_id = :user_id');
        return $task->execute([
            ':id' => $id,
            ':title' => $title,
            ':description' => $description,
            ':user_id' => $userId
        ]);
    }
}
