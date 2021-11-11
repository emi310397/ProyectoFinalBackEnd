<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Teacher;

use Application\Commands\Teacher\CreateTeacherCommand;
use Application\Events\UserCreated;
use Application\Services\Event\EventDispatcherService;
use Application\Validators\Auth\CreateUserValidator;
use Domain\Entities\Teacher;
use Domain\Enums\TokenTypes;
use Domain\Interfaces\Repositories\UserRepositoryInterface;
use Domain\Services\CreateTokenService;

class CreateTeacherHandler
{
    private UserRepositoryInterface $userRepository;
    private CreateTokenService $createTokenService;
    private CreateUserValidator $validator;
    private EventDispatcherService $eventDispatcher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        CreateTokenService $createTokenService,
        CreateUserValidator $validator,
        EventDispatcherService $eventDispatcher
    ) {
        $this->userRepository = $userRepository;
        $this->createTokenService = $createTokenService;
        $this->validator = $validator;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(CreateTeacherCommand $command): void
    {
        $this->validator->validate($command->getEmail());

        $teacher = new Teacher(
            $command->getFirstName(),
            $command->getLastName(),
            $command->getEmail(),
            $command->getPassword()
        );

        $this->userRepository->save($teacher);

        $token = $this->createTokenService->handle($teacher, TokenTypes::ACCOUNT_REGISTER);

        $this->eventDispatcher->handle(
            new UserCreated(
                $command->getEmail(),
                $command->getConfirmationUrl(),
                $token->getHash()
            )
        );
    }
}
