<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class PClass
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    private Course $course;
    private string $subject;
    private string $description;
    private DateTime $fromDate;
    private DateTime $toDate;
    private Collection $tasks;

    public function __construct(
        Course $course,
        string $subject,
        string $description,
        DateTime $fromDate,
        DateTime $toDate
    ) {
        $this->course = $course;
        $this->subject = $subject;
        $this->description = $description;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->tasks = new ArrayCollection();
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
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

    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): void
    {
        $this->tasks->add($task);
    }
}
