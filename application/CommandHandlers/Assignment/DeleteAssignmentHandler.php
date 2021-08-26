<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Assignment;

use Application\Commands\Assignment\DeleteAssignmentCommand;
use Domain\Interfaces\Repositories\AssignmentRepositoryInterface;

class DeleteAssignmentHandler
{
    private AssignmentRepositoryInterface $assignmentRepository;

    public function __construct(
        AssignmentRepositoryInterface $assignmentRepository
    ) {
        $this->assignmentRepository = $assignmentRepository;
    }

    public function handle(DeleteAssignmentCommand $command): void
    {
        $this->assignmentRepository->delete($command->getAssignment());
    }
}
