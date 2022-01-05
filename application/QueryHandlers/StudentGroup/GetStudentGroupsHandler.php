<?php

declare(strict_types=1);

namespace Application\QueryHandlers\StudentGroup;

use Application\Queries\StudentGroup\GetStudentGroupQuery;
use Application\Queries\StudentGroup\GetStudentGroupsQuery;
use Application\Results\StudentGroup\StudentGroupResult;
use Application\Results\StudentGroup\StudentGroupsResult;

class GetStudentGroupsHandler
{
    public function handle(GetStudentGroupsQuery $command): StudentGroupsResult
    {
        return new StudentGroupsResult($command->getStudentGroup());
    }
}
