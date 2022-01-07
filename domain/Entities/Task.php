<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class Task
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    private Course $course;
    private string $title;
    private string $description;
    private DateTime $fromDate;
    private DateTime $toDate;
    private Collection $assignments;
    private Collection $activities;

    public function __construct(
        Course $course,
        string $title,
        string $description,
        DateTime $fromDate,
        DateTime $toDate
    ) {
        $this->course = $course;
        $this->title = $title;
        $this->description = $description;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->assignments = new ArrayCollection();
        $this->activities = new ArrayCollection();
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }

    public function getCourse(): Course
    {
        return $this->course;
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

    public function getAssignments(): Collection
    {
        return $this->assignments;
    }

    public function addAssignment(Assignment $assignment): void
    {
        $this->assignments->add($assignment);
    }

    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivities(Activity $activity): void
    {
        $this->activities->add($activity);
    }
}
