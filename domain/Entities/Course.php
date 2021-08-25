<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private Teacher $teacher;
    private Collection $students;
    private Collection $classes;

    public function __construct(string $title, string $description, Teacher $teacher)
    {
        $this->title = $title;
        $this->description = $description;
        $this->teacher = $teacher;
        $this->students = new ArrayCollection();
        $this->classes = new ArrayCollection();
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

    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(PClass $class): void
    {
        $this->classes->add($class);
    }
}
