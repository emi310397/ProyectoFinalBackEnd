<?php

declare(strict_types=1);

namespace Application\QueryHandlers\Assignment;

use Application\Queries\Assignment\GetAssignmentQuery;
use Application\Results\Assignment\AssignmentResult;

class GetAssignmentHandler
{
    public function handle(GetAssignmentQuery $command): AssignmentResult
    {
        return new AssignmentResult($command->getAssignment());
    }
}
