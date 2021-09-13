<?php

declare(strict_types=1);

namespace Application\CommandHandlers\StudentGroup;

use Application\Commands\StudentGroup\CreateStudentGroupCommand;
use Domain\Entities\StudentGroup;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;

class CreateStudentGroupHandler
{
    private StudentGroupRepositoryInterface $studentGroupRepository;

    public function __construct(
        StudentGroupRepositoryInterface $studentGroupRepository
    ) {
        $this->studentGroupRepository = $studentGroupRepository;
    }

    public function handle(CreateStudentGroupCommand $command): void
    {
        $studentGroup = new StudentGroup(
            $command->getName(),
            $command->getDescription(),
            $command->getCourse(),
            $command->getStudents()
        );

        $this->studentGroupRepository->save($studentGroup);
    }
}
