<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Assignment;

use Application\Commands\Assignment\CreateAssignmentCommand;
use Domain\Entities\Assignment;
use Domain\Interfaces\Repositories\AssignmentRepositoryInterface;

class CreateAssignmentHandler
{
    private AssignmentRepositoryInterface $assignmentRepository;

    public function __construct(
        AssignmentRepositoryInterface $assignmentRepository
    ) {
        $this->assignmentRepository = $assignmentRepository;
    }

    public function handle(CreateAssignmentCommand $command): void
    {
        $assignment = new Assignment(
            $command->getTask(),
            $command->getStudents()
        );

        $this->assignmentRepository->save($assignment);
    }
}
