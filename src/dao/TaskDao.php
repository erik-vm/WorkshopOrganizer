<?php

class TaskDao
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = getConnection();
    }


    public function saveTask(int $taskId, string $description,  int $assignedTo, bool $completed): string
    {
        try {
            if ($taskId) {
                $statement = $this->connection->prepare(
                    'UPDATE task 
                     SET description = :description, assigned_to = :assigned_to, completed = :completed
                     WHERE task_id = :task_id'
                );
                $statement->execute([
                    ':task_id' => $taskId,
                    ':description' => $description,
                    ':assigned_to' => $assignedTo,
                    ':completed' => intval($completed)
                ]);
                return "Updated!";
            } else {
                $statement = $this->connection->prepare(
                    'INSERT INTO task (description, assigned_to, completed)
                     VALUES (:description,  :assigned_to, :completed)'
                );
                $statement->execute([
                    ':description' => $description,
                    ':assigned_to' => $assignedTo,
                    ':completed' => intval($completed)
                ]);
                return "Saved!";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function deleteTask(int $taskId): string
    {
        try {
            $statement = $this->connection->prepare('DELETE FROM task WHERE task_id = :task_id');
            $statement->execute([':task_id' => $taskId]);
            return "Deleted!";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getTask(int $taskId): ?Task
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM task WHERE task_id = :task_id');
            $statement->execute([':task_id' => $taskId]);
            $item = $statement->fetch(PDO::FETCH_ASSOC);

            if ($item) {
                return new Task($item['task_id'], $item['description'], $item['assigned_to'], $item['completed']);
            }
            return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getAllTasks(): array
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM task');
            $statement->execute();
            $items = $statement->fetchAll(PDO::FETCH_ASSOC);

            $result = [];
            foreach ($items as $item) {
                $result[] = new Task($item['task_id'], $item['description'], $item['assigned_to'], $item['completed']);
            }
            return $result;
        } catch (PDOException $e) {
            return [];
        }
    }

}