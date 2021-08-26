<?php

declare(strict_types=1);

namespace Application\Commands\StudentGroup;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\Course;

class CreateStudentGroupCommand implements CommandInterface
{
    private string $name;
    private string $description;
    private Course $course;
    private array $students;

    public function __construct(string $name, string $description, Course $course, array $students)
    {
        $this->name = $name;
        $this->description = $description;
        $this->course = $course;
        $this->students = $students;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function getStudents(): array
    {
        return $this->students;
    }
}
