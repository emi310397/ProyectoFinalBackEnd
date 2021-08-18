<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\Task;

use Application\Results\Task\TaskResult;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class TaskPresenter implements PresenterInterface
{
    private TaskResult $result;

    public function fromResult(TaskResult $result): TaskPresenter
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
        $task = $this->result->getTask();

        return [
            'id' => $task->getId(),
            'subject' => $task->getTitle(),
            'description' => $task->getDescription(),
            'fromDate' => $task->getFromDate(),
            'toDate' => $task->getToDate()
        ];
    }
}
