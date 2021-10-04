<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Teacher;

use Application\Commands\Teacher\CreateTeacherCommand;
use Domain\Entities\Teacher;
use Domain\Interfaces\Repositories\UserRepositoryInterface;

class CreateTeacherHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function handle(CreateTeacherCommand $command): void
    {
        $teacher = new Teacher(
            $command->getFirstName(),
            $command->getLastName(),
            $command->getEmail(),
            $command->getPassword()
        );

        $this->userRepository->save($teacher);
    }
}
