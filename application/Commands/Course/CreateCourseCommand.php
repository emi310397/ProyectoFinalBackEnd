<?php

declare(strict_types=1);

namespace Application\Commands\Course;

use DateTime;
use Domain\CommandBus\CommandInterface;

class CreateCourseCommand implements CommandInterface
{
    private string $title;
    private string $description;
    private DateTime $fromDate;
    private DateTime $toDate;
    private array $days;

    public function __construct(
        string $title,
        string $description,
        string $fromDate,
        string $toDate,
        array $days = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->fromDate = new DateTime($fromDate);
        $this->toDate = new DateTime($toDate);
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

    public function getFromDate(): DateTime
    {
        return $this->fromDate;
    }

    public function getToDate(): DateTime
    {
        return $this->toDate;
    }

    public function getDays(): ?array
    {
        return $this->days;
    }
}
