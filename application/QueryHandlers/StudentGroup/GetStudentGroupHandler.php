<?php

declare(strict_types=1);

namespace Application\QueryHandlers\StudentGroup;

use Application\Queries\StudentGroup\GetStudentGroupQuery;
use Application\Results\StudentGroup\StudentGroupResult;

class GetStudentGroupHandler
{
    public function handle(GetStudentGroupQuery $command): StudentGroupResult
    {
        return new StudentGroupResult($command->getStudentGroup());
    }
}
