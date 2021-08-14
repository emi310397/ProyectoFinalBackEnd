<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class Task
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    private PClass $PClass;
    private string $title;
    private string $description;
    private DateTime $fromDate;
    private DateTime $toDate;

    public function __construct(
        PClass $PClass,
        string $title,
        string $description,
        DateTime $fromDate,
        DateTime $toDate
    ) {
        $this->PClass = $PClass;
        $this->title = $title;
        $this->description = $description;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }

    public function getPClass(): PClass
    {
        return $this->PClass;
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
}
