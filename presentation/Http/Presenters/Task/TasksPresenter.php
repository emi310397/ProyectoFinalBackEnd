<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\Task;

use Application\Results\Task\TasksResult;
use Domain\Entities\Task;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class TasksPresenter implements PresenterInterface
{
    private TasksResult $result;

    public function fromResult(TasksResult $result): TasksPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function toJson(): string
    {
        return json_encode($this->getData());
    }

    public function getData(): array
    {
        $tasks = $this->result->getTasksResults();

        return [
            'tasks' => $this->getTasksIds($tasks)
        ];
    }

    private function getTasksIds(array $tasks): array
    {
        $tasksIds = [];

        /* @var Task $task */
        foreach ($tasks as $task) {
            $tasksIds[] = $task->getId();
        }

        return $tasksIds;
    }
}
