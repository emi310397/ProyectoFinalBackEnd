<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class User
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    private string $firstName;
    private string $lastName;
    private string $password;
    private ?Teacher $teacher = null;
    private ?Student $student = null;

    public function __construct(string $firstName, string $lastName, string $password)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(Teacher $teacher): void
    {
        $this->teacher = $teacher;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(Student $student): void
    {
        $this->student = $student;
    }

    public function isTeacher(): bool
    {
        $teacher = $this->getTeacher();

        return ($teacher !== null) && !$teacher->getDeletedAt();
    }

    public function isStudent(): bool
    {
        $student = $this->getStudent();

        return ($student !== null) && !$student->getDeletedAt();
    }
}
