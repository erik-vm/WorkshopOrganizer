<?php

class EmployeeDao
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = getConnection();
    }

    public function saveEmployee(int $employeeId, string $firstName, string $lastName, string $position, string $email, string $picture): string
    {
        try {
            if ($employeeId) {
                $statement = $this->connection->prepare(
                    'UPDATE employee 
                     SET first_name = ?, last_name = ?, email = ?,  position = ?, picture = ?
                     WHERE employee_id = ?'
                );
                $statement->execute([
                    $firstName,
                    $lastName,
                    $email,
                    $position,
                    $picture,
                    $employeeId
                ]);
                return "Updated!";
            } else {
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

            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function deleteEmployee(int $employeeId): string
    {
        try {
            $statement = $this->connection->prepare('DELETE FROM employee WHERE employee_id = ?');
            $statement->execute([$employeeId]);
            return 'Deleted!';
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getEmployee(int $employeeId): ?Employee
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM employee WHERE employee_id = ?');
            $statement->execute([$employeeId]);
            $item = $statement->fetch(PDO::FETCH_ASSOC);

            if ($item) {
                return new Employee($item['employee_id'], $item['first_name'], $item['email'], $item['last_name'], $item['position'], $item['picture']);
            }
            return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getAllEmployees()
    {
        try {
            if (!$this->connection) {
                error_log("Database connection failed.");
                return [];
            }

            $statement = $this->connection->query('SELECT * FROM employee ORDER BY employee_id DESC');
            $statement->execute();
            $items = $statement->fetchAll(PDO::FETCH_ASSOC);

            $result = [];
            foreach ($items as $item) {
                $result[] = new Employee($item['employee_id'], $item['first_name'], $item['last_name'], $item['email'], $item['position'], $item['picture']);
            }
            return $result;
        } catch (PDOException $e) {
            error_log("Error fetching employees: " . $e->getMessage());
            return [];
        }
    }
}