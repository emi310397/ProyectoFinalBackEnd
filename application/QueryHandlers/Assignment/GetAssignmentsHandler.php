<?php

declare(strict_types=1);

namespace Application\QueryHandlers\Assignment;

use Application\Queries\Assignment\GetAssignmentsQuery;
use Application\Results\Assignment\AssignmentResult;
use Application\Results\Assignment\AssignmentsResult;
use Domain\Interfaces\Repositories\AssignmentRepositoryInterface;

class GetAssignmentsHandler
{
    private AssignmentRepositoryInterface $assignmentRepository;

    public function __construct(
        AssignmentRepositoryInterface $assignmentRepository
    ) {
        $this->assignmentRepository = $assignmentRepository;
    }

    public function handle(GetAssignmentsQuery $command): AssignmentsResult
    {
        $assignmentsResults = [];
        $user = $command->getUser();

        $assignments = $this->assignmentRepository->getAllByUser($user);

        foreach ($assignments as $assignment) {
            $assignmentsResults[] = new AssignmentResult($assignment);
        }

        return new AssignmentsResult($assignmentsResults);
    }
}
