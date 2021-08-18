<?php

declare(strict_types=1);

namespace Application\Commands\Task;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\Task;

class DeleteTaskCommand implements CommandInterface
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
