<?php

declare(strict_types=1);

namespace Application\Results\Assignment;

class AssignmentsResult
{
    private array $assignmentsResults;

    public function __construct(array $assignmentsResults)
    {
        $this->assignmentsResults = $assignmentsResults;
    }

    public function getAssignmentsResults(): array
    {
        return $this->assignmentsResults;
    }
}
