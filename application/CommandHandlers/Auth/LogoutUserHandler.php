<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Auth;

use Application\Commands\Auth\LogoutUserCommand;
use Domain\Interfaces\Repositories\SessionRepositoryInterface;
use Presentation\Services\ExpirationSessionService;

class LogoutUserHandler
{
    private SessionRepositoryInterface $sessionRepository;
    private ExpirationSessionService $expirationSession;

    public function __construct(
        SessionRepositoryInterface $sessionRepository,
        ExpirationSessionService $expirationSession
    ) {
        $this->sessionRepository = $sessionRepository;
        $this->expirationSession = $expirationSession;
    }

    public function handle(LogoutUserCommand $command): void
    {
        $session = $this->sessionRepository->getByHash($command->getHash());

        if ($session !== null) {
            $this->expirationSession->expireSession($session);
        }

        $this->sessionRepository->update();
    }
}
