<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Auth;

use Application\Commands\Auth\LoginUserCommand;
use Application\Exceptions\DomainException;
use Application\Results\Auth\LoginUserResult;
use Application\Validators\Auth\LoginUserValidator;
use Domain\Enums\UserStatuses;
use Domain\Services\CreateSessionService;

class LoginUserHandler
{
    private LoginUserValidator $loginUserValidator;
    private CreateSessionService $createSessionService;

    public function __construct(
        LoginUserValidator $loginUserValidator,
        CreateSessionService $createSessionService
    ) {
        $this->loginUserValidator = $loginUserValidator;
        $this->createSessionService = $createSessionService;
    }

    public function handle(LoginUserCommand $command): LoginUserResult
    {
        $this->loginUserValidator->validate($command);

        $session = $this->createSessionService->handle($command->getUser());

        return new LoginUserResult(UserStatuses::ACTIVATED, $session);
    }
}
