<?php

declare(strict_types=1);

namespace Domain\Entities;

use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class Activity
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

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

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function setTask(Task $task): void
    {
        $this->task = $task;
    }
}
