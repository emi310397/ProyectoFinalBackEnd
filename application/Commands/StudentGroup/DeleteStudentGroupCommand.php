<?php

declare(strict_types=1);

namespace Application\Commands\StudentGroup;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\StudentGroup;

class DeleteStudentGroupCommand implements CommandInterface
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
