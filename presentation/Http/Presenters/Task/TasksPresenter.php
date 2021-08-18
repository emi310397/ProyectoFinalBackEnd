<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\Task;

use Application\Results\Task\TaskResult;
use Application\Results\Task\TasksResult;
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
        $data = [];
        $tasksResults = $this->result->getTasksResults();

        $taskPresenter = new TaskPresenter();

        /* @var TaskResult $taskResult */
        foreach ($tasksResults as $taskResult) {
            $taskPresenter->fromResult($taskResult);

            $data[] = $taskPresenter->getData();
        }

        return $data;
    }
}
