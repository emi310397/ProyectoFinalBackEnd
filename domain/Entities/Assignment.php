<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class Assignment
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    private Task $task;
    private Collection $students;

    public function __construct(Task $task, array $students)
    {
        $this->task = $task;
        $this->students = new ArrayCollection($students);
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudents(Student $student): void
    {
        $this->students->add($student);
    }
}
