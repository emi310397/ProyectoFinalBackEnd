<?php

declare(strict_types=1);

namespace Application\Results\StudentGroup;

use Domain\Entities\StudentGroup;

class StudentGroupResult
{
    private StudentGroup $studentGroup;

    public function __construct(StudentGroup $studentGroup)
    {
        $this->studentGroup = $studentGroup;
    }

    public function getStudentGroup(): StudentGroup
    {
        return $this->studentGroup;
    }
}
