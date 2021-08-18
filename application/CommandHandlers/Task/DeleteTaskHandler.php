<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Task;

use Application\Commands\Task\DeleteTaskCommand;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;

class DeleteTaskHandler
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(
        TaskRepositoryInterface $taskRepository
    ) {
        $this->taskRepository = $taskRepository;
    }

    public function handle(DeleteTaskCommand $command): void
    {
        $this->taskRepository->delete($command->getTask());
    }
}
