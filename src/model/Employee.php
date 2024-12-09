<?php

class Employee
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $position;

    private string $picture;


    public function __construct(int $id, string $firstName, string $lastName, string $email, string $position, ?string $picture = null)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->position = $position;
        $this->picture = $picture;
    }

    public function __toString(): string
    {
        return "$this->firstName $this->lastName";
    }
}