<?php
require_once __DIR__ . '../config/connection.php';


class EmployeeDao
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = getConnection();
    }
    public function saveEmployee(string $firstName, string $lastName, string $position, string $email, string $picture): string
    {
        try {

            $statement = $this->connection->prepare(
                'INSERT INTO employee (first_name, last_name, position, email, picture)
                     VALUES (?, ?, ?, ?, ?)'
            );
            $statement->execute([
                $firstName,
                $lastName,
                $position,
                $email,
                $picture
            ]);
            return "Saved!";

        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}