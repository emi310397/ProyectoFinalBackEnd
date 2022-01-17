<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Task;

use Application\Commands\Task\CreateTaskCommand;
use Application\Validators\Course\UserToCourseMembershipValidator;
use Domain\Entities\Task;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;

class CreateTaskHandler
{
    private TaskRepositoryInterface $taskRepository;
    private UserToCourseMembershipValidator $validator;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        UserToCourseMembershipValidator $validator
    ) {
        $this->taskRepository = $taskRepository;
        $this->validator = $validator;
    }

    public function handle(CreateTaskCommand $command): void
    {
        $course = $command->getCourse();

        $this->validator->validateCurrentUser($course);

        $task = new Task(
            $course,
            $command->getTitle(),
            $command->getDescription(),
            $command->getFromDate(),
            $command->getToDate(),
        );

        $this->taskRepository->save($task);
    }
}
