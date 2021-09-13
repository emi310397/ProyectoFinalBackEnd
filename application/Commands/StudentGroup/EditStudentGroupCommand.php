<?php

declare(strict_types=1);

namespace Application\Commands\StudentGroup;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\StudentGroup;

class EditStudentGroupCommand implements CommandInterface
{
    private StudentGroup $studentGroup;
    private string $name;
    private string $description;
    private array $students;

    public function __construct(StudentGroup $studentGroup, string $name, string $description, array $students)
    {
        $this->studentGroup = $studentGroup;
        $this->name = $name;
        $this->description = $description;
        $this->students = $students;
    }

    public function getStudentGroup(): StudentGroup
    {
        return $this->studentGroup;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStudents(): array
    {
        return $this->students;
    }
}
