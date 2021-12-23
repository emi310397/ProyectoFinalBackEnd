<?php

declare(strict_types=1);

namespace Application\Commands\Activity;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\Task;

class CreateActivityCommand implements CommandInterface
{

    private string $title;
    private int $type;
    private string $description;
    private string $body;
    private Task $task;

    public function __construct(
        string $title,
        int $type,
        string $description,
        string $body,
        Task $task
    ) {
        $this->title = $title;
        $this->type = $type;
        $this->description = $description;
        $this->body = $body;
        $this->task = $task;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getTask(): Task
    {
        return $this->task;
    }
}
