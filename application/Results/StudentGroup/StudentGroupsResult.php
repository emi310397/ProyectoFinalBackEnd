<?php

declare(strict_types=1);

namespace Application\Results\StudentGroup;

class StudentGroupsResult
{
    private array $studentGroups;

    public function __construct(array $studentGroups)
    {
        $this->studentGroups = $studentGroups;
    }

    public function getStudentGroups(): array
    {
        return $this->studentGroups;
    }
}
