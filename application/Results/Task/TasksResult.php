<?php

declare(strict_types=1);

namespace Application\Results\Task;

class TasksResult
{
    private array $tasksResults;

    public function __construct(array $tasksResults)
    {
        $this->tasksResults = $tasksResults;
    }

    public function getTasksResults(): array
    {
        return $this->tasksResults;
    }
}
