<?php

declare(strict_types=1);

namespace Application\Commands\Assignment;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\Task;

class CreateAssignmentCommand implements CommandInterface
{
    private Task $task;
    private array $students;

    public function __construct(Task $task, array $students)
    {
        $this->task = $task;
        $this->students = $students;
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function getStudents(): array
    {
        return $this->students;
    }
}
