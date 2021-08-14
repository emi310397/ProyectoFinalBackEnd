<?php

declare(strict_types=1);

namespace Application\Commands\Task;

use DateTime;
use Domain\CommandBus\CommandInterface;
use Domain\Entities\PClass;

class CreateTaskCommand implements CommandInterface
{
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
    }

    public function getPClass(): PClass
    {
        return $this->PClass;
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
