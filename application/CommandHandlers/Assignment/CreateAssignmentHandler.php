<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Assignment;

use Application\Commands\Assignment\CreateAssignmentCommand;
use Application\Validators\StudentGroup\StudentGroupToCourseMembershipValidator;
use Domain\Entities\Assignment;
use Domain\Interfaces\Repositories\AssignmentRepositoryInterface;

class CreateAssignmentHandler
{
    private AssignmentRepositoryInterface $assignmentRepository;
    private StudentGroupToCourseMembershipValidator $validator;

    public function __construct(
        AssignmentRepositoryInterface $assignmentRepository,
        StudentGroupToCourseMembershipValidator $validator
    ) {
        $this->assignmentRepository = $assignmentRepository;
        $this->validator = $validator;
    }

    public function handle(CreateAssignmentCommand $command): void
    {
        $course = $command->getTask()->getClasses()->first()->getCourse();
        $this->validator->validate($command->getStudentGroups(), $course);

        $assignment = new Assignment(
            $command->getTask(),
            $command->getStudentGroups()
        );

        $this->assignmentRepository->save($assignment);
    }
}
