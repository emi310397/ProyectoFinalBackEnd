<?php

declare(strict_types=1);

namespace Application\Commands\Course;

use Domain\CommandBus\CommandInterface;

class CreateCourseCommand implements CommandInterface
{
    private string $title;
    private string $description;
    private array $days;

    public function __construct(
        string $title,
        string $description,
        array $days = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->days = $days;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDays(): ?array
    {
        return $this->days;
    }
}
