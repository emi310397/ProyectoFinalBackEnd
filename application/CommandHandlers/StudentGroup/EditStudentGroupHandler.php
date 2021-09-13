<?php

declare(strict_types=1);

namespace Application\CommandHandlers\StudentGroup;

use Application\Commands\StudentGroup\EditStudentGroupCommand;
use DateTime;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;

class EditStudentGroupHandler
{
    private StudentGroupRepositoryInterface $studentGroupRepository;

    public function __construct(
        StudentGroupRepositoryInterface $studentGroupRepository
    ) {
        $this->studentGroupRepository = $studentGroupRepository;
    }

    public function handle(EditStudentGroupCommand $command): void
    {
        $studentGroup = $command->getStudentGroup();

        $command->getName() ? $studentGroup->setName($command->getName()) : null;
        $command->getDescription() ? $studentGroup->setDescription($command->getDescription()) : null;
        if ($command->getStudents()) {
            foreach ($command->getStudents() as $student) {
                $studentGroup->addStudent($student);
            }
        }
        $studentGroup->setUpdatedAt(new DateTime());

        $this->studentGroupRepository->update();
    }
}
