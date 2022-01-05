<?php

declare(strict_types=1);

namespace Application\Queries\StudentGroup;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\StudentGroup;

class GetStudentGroupsQuery implements CommandInterface
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
