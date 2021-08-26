<?php

declare(strict_types=1);

namespace Application\Commands\Assignment;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\Task;

class CreateAssignmentCommand implements CommandInterface
{
    private Task $task;
    private array $studentGroups;

    public function __construct(Task $task, array $studentGroups)
    {
        $this->task = $task;
        $this->studentGroups = $studentGroups;
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function getStudentGroups(): array
    {
        return $this->studentGroups;
    }
}
