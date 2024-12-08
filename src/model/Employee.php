<?php

class Employee
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $position;

    private string $picture;

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $position
     * @param string $picture
     */
    public function __construct(int $id, string $firstName, string $lastName, string $email, string $position, string $picture)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->position = $position;
        $this->picture = $picture;
    }
}