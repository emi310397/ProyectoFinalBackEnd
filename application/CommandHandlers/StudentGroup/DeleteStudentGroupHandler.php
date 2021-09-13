<?php

declare(strict_types=1);

namespace Application\CommandHandlers\StudentGroup;

use Application\Commands\StudentGroup\DeleteStudentGroupCommand;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;

class DeleteStudentGroupHandler
{
    private StudentGroupRepositoryInterface $studentGroupRepository;

    public function __construct(
        StudentGroupRepositoryInterface $studentGroupRepository
    ) {
        $this->studentGroupRepository = $studentGroupRepository;
    }

    public function handle(DeleteStudentGroupCommand $command): void
    {
        $this->studentGroupRepository->delete($command->getStudentGroup());
    }
}
