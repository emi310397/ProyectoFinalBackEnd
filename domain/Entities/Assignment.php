<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class Assignment
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    private Task $task;
    private User $student;

    public function __construct(Task $task, User $student)
    {
        $this->task = $task;
        $this->student = $student;
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }

    public function getTask(): Task
    {
        return $this->task;
    }

    public function getStudent(): User
    {
        return $this->student;
    }
}
