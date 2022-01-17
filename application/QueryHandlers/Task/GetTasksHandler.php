<?php

declare(strict_types=1);

namespace Application\QueryHandlers\Task;

use Application\Queries\Task\GetTasksQuery;
use Application\Results\Task\TaskResult;
use Application\Results\Task\TasksResult;
use Application\Validators\Course\UserToCourseMembershipValidator;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;

class GetTasksHandler
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

    public function handle(GetTasksQuery $command): TasksResult
    {
        $course = $command->getCourse();

        $this->validator->validateCurrentUser($course);

        $tasksResults = [];

        $tasks = $this->taskRepository->getAllByCourse($course);

        foreach ($tasks as $task) {
            $tasksResults[] = new TaskResult($task);
        }

        return new TasksResult($tasksResults);
    }
}
