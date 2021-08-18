<?php

declare(strict_types=1);

namespace Application\Queries\Task;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\Task;

class GetTaskQuery implements CommandInterface
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
