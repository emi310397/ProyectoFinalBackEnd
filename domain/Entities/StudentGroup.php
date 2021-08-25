<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class StudentGroup
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    private string $name;
    private string $description;
    private Course $course;
    private Collection $students;

    public function __construct(string $name, string $description, Course $course, array $students = [])
    {
        $this->name = $name;
        $this->description = $description;
        $this->course = $course;
        $this->students = new ArrayCollection($students);
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): void
    {
        $this->students->add($student);
    }
}
