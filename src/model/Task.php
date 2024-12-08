<?php

class Task
{
    private int $id;
    private string $description;
    private ?int $assignedTo;
    private bool $completed;

    public function __construct(int $id, string $description, ?int $assignedTo = null, bool $completed = false)
    {
        $this->id = $id;
        $this->description = $description;
        $this->assignedTo = $assignedTo;
        $this->completed = $completed;
    }
}