<?php

declare(strict_types=1);

namespace Application\Commands\Task;

use DateTime;
use Domain\CommandBus\CommandInterface;
use Domain\Entities\Course;

class CreateTaskCommand implements CommandInterface
{
    private Course $course;
    private string $title;
    private string $description;
    private DateTime $fromDate;
    private DateTime $toDate;

    public function __construct(
        Course $course,
        string $title,
        string $description,
        string $fromDate,
        string $toDate
    ) {
        $this->course = $course;
        $this->title = $title;
        $this->description = $description;
        $this->fromDate = new DateTime($fromDate);
        $this->toDate = new DateTime($toDate);
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

    public function getFromDate(): DateTime
    {
        return $this->fromDate;
    }

    public function getToDate(): DateTime
    {
        return $this->toDate;
    }
}
