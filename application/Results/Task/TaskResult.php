<?php

declare(strict_types=1);

namespace Application\Results\Task;

use Domain\Entities\Task;

class TaskResult
{
    private Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getTask(): Task
    {
        return $this->task;
    }
}
