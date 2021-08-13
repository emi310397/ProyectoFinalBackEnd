<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Task;

use Application\Commands\Task\CreateTaskCommand;
use Domain\Entities\Task;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;

class CreateTaskHandler
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository
    ) {
        $this->taskRepository = $taskRepository;
    }

    public function handle(CreateTaskCommand $command): void
    {
        $task = new Task(
            $command->getPClass(),
            $command->getTitle(),
            $command->getDescription(),
            $command->getFromDate(),
            $command->getToDate(),
        );

        $this->taskRepository->save($task);
    }
}
