<?php

declare(strict_types=1);

namespace Application\Commands\Course;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\Course;

class EditCourseCommand implements CommandInterface
{
    private Course $course;
    private string $title;
    private string $description;
    private array $days;

    public function __construct(
        Course $course,
        string $title,
        string $description,
        array $days = null
    ) {
        $this->course = $course;
        $this->title = $title;
        $this->description = $description;
        $this->days = $days;
    }

    public function getCourse(): Course
    {
        return $this->course;
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
