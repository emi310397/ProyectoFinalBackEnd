<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Task;

use Application\Commands\Task\EditTaskCommand;
use DateTime;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;

class EditTaskHandler
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository
    ) {
        $this->taskRepository = $taskRepository;
    }

    public function handle(EditTaskCommand $command): void
    {
        $task = $command->getTask();

        $command->getTitle() ? $task->setTitle($command->getTitle()) : null;
        $command->getDescription() ? $task->setDescription($command->getDescription()) : null;
        $command->getFromDate() ? $task->setFromDate($command->getFromDate()) : null;
        $command->getToDate() ? $task->setToDate($command->getToDate()) : null;
        $task->setUpdatedAt(new DateTime());

        $this->taskRepository->update();
    }
}
