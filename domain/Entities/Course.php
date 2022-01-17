<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Enums\DaysOfTheWeek;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class Course
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    private string $title;
    private string $description;
    private array $days;
    private DateTime $fromDate;
    private DateTime $toDate;
    private Teacher $teacher;
    private Collection $students;
    private Collection $tasks;

    public function __construct(
        string $title,
        string $description,
        DateTime $fromDate,
        DateTime $toDate,
        Teacher $teacher,
        ?array $days = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->teacher = $teacher;
        $this->days = $days ?: DaysOfTheWeek::ALL_DAYS;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->students = new ArrayCollection();
        $this->tasks = new ArrayCollection();
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDays(): array
    {
        return $this->days;
    }

    public function setDays(array $days): void
    {
        $this->days = $days;
    }

    public function getFromDate(): DateTime
    {
        return $this->fromDate;
    }

    public function setFromDate(DateTime $fromDate): void
    {
        $this->fromDate = $fromDate;
    }

    public function getToDate(): DateTime
    {
        return $this->toDate;
    }

    public function setToDate(DateTime $toDate): void
    {
        $this->toDate = $toDate;
    }

    public function getTeacher(): Teacher
    {
        return $this->teacher;
    }

    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudents(StudentGroup $students): void
    {
        $this->students->add($students);
    }

    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): void
    {
        $this->tasks->add($task);
    }
}
