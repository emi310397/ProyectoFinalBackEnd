<?php

declare(strict_types=1);

namespace Application\QueryHandlers\Task;

use Application\Queries\Task\GetTaskQuery;
use Application\Results\Task\TaskResult;

class GetTaskHandler
{
    public function handle(GetTaskQuery $command): TaskResult
    {
        return new TaskResult($command->getTask());
    }
}
