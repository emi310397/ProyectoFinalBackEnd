<?php

declare(strict_types=1);

namespace Application\Queries\Assignment;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\Assignment;

class GetAssignmentQuery implements CommandInterface
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
