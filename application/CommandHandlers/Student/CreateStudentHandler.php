<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Student;

use Application\Commands\Student\CreateStudentCommand;
use Application\Events\UserCreated;
use Application\Services\Encrypt\EncryptService;
use Application\Services\Event\EventDispatcherService;
use Application\Validators\Auth\CreateUserValidator;
use Domain\Entities\Student;
use Domain\Enums\TokenTypes;
use Domain\Interfaces\Repositories\UserRepositoryInterface;
use Domain\Services\CreateTokenService;

class CreateStudentHandler
{
    private UserRepositoryInterface $userRepository;
    private CreateTokenService $createTokenService;
    private CreateUserValidator $validator;
    private EncryptService $encryptService;
    private EventDispatcherService $eventDispatcher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        CreateTokenService $createTokenService,
        CreateUserValidator $validator,
        EncryptService $encryptService,
        EventDispatcherService $eventDispatcher
    ) {
        $this->userRepository = $userRepository;
        $this->createTokenService = $createTokenService;
        $this->validator = $validator;
        $this->encryptService = $encryptService;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(CreateStudentCommand $command): void
    {
        $this->validator->validate($command->getEmail());

        $student = new Student(
            $command->getFirstName(),
            $command->getLastName(),
            $command->getEmail(),
            $this->encryptService->encryptPassword($command->getPassword())
        );

        $this->userRepository->save($student);

        $token = $this->createTokenService->handle($student, TokenTypes::ACCOUNT_REGISTER);

        $this->eventDispatcher->handle(
            new UserCreated(
                $command->getEmail(),
                $command->getConfirmationUrl(),
                $token->getHash()
            )
        );
    }
}
