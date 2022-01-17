<?php

declare(strict_types=1);

namespace Application\Commands\Task;

use DateTime;
use Domain\CommandBus\CommandInterface;
use Domain\Entities\Task;

class EditTaskCommand implements CommandInterface
{
    private Task $task;
    private ?string $title;
    private ?string $description;
    private ?DateTime $fromDate;
    private ?DateTime $toDate;

    public function __construct(
        Task $task,
        ?string $title,
        ?string $description,
        ?string $fromDate,
        ?string $toDate
    ) {
        $this->task = $task;
        $this->title = $title;
        $this->description = $description;
        $this->fromDate = new DateTime($fromDate);
        $this->toDate = new DateTime($toDate);
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getFromDate(): ?DateTime
    {
        return $this->fromDate;
    }

    public function getToDate(): ?DateTime
    {
        return $this->toDate;
    }
}
