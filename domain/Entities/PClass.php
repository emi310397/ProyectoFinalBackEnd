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

    private string $subject;
    private string $description;
    private Collection $tasks;

    public function __construct(string $subject, string $description)
    {
        $this->subject = $subject;
        $this->description = $description;
        $this->tasks = new ArrayCollection();
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
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

    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): void
    {
        $this->tasks->add($task);
    }
}
