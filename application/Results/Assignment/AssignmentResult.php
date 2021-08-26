<?php

declare(strict_types=1);

namespace Application\Results\Assignment;

use Domain\Entities\Assignment;

class AssignmentResult
{
    private Assignment $assignment;

    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment;
    }

    public function getAssignment(): Assignment
    {
        return $this->assignment;
    }
}
