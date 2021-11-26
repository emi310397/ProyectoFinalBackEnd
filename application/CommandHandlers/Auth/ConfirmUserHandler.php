<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Auth;

use Application\Commands\Auth\ConfirmUserCommand;
use Application\Exceptions\DomainRuntimeException;
use Application\Results\Auth\ConfirmUserResult;
use DateTime;
use Domain\Enums\TokenTypes;
use Domain\Interfaces\Repositories\TokenRepositoryInterface;
use Domain\Interfaces\Repositories\UserRepositoryInterface;
use Domain\Services\CreateSessionService;

class ConfirmUserHandler
{
    private UserRepositoryInterface $userRepository;
    private TokenRepositoryInterface $tokenRepository;
    private CreateSessionService $createSessionService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        TokenRepositoryInterface $tokenRepository,
        CreateSessionService $createSessionService
    ) {
        $this->userRepository = $userRepository;
        $this->tokenRepository = $tokenRepository;
        $this->createSessionService = $createSessionService;
    }

    public function handle(ConfirmUserCommand $command): ConfirmUserResult
    {
        $user = $command->getToken()->getUser();

        if ($user->isActivated()) {
            throw new DomainRuntimeException(__('The user account is already confirmed'));
        }

        $user->activate();
        $this->tokenRepository->update();

        $accountConfirmationTokens = $this->tokenRepository->getAllByUserAndType($user, TokenTypes::ACCOUNT_REGISTER);
        foreach ($accountConfirmationTokens as $token) {
            $token->expire();
            $token->setUpdatedAt(new DateTime());
        }
        $this->userRepository->update();

        $session = $this->createSessionService->handle($user);

        return new ConfirmUserResult($session);
    }
}
