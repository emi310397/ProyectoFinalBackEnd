<?php

declare(strict_types=1);

namespace Application\QueryHandlers\Task;

use Application\Queries\Task\GetTasksQuery;
use Application\Results\Task\TaskResult;
use Application\Results\Task\TasksResult;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;

class GetTasksHandler
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository
    ) {
        $this->taskRepository = $taskRepository;
    }

    public function handle(GetTasksQuery $command): TasksResult
    {
        $tasksResults = [];
        $user = $command->getUser();

        $tasks = $this->taskRepository->getAllByUser($user);

        foreach ($tasks as $task) {
            $tasksResults[] = new TaskResult($task);
        }

        return new TasksResult($tasksResults);
    }
}
