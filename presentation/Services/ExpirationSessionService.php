<?php

declare(strict_types=1);

namespace Presentation\Services;

use Domain\Entities\Session;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\SessionRepositoryInterface;
use Presentation\Http\Services\ExpireCacheSessionService;

class ExpirationSessionService
{
    private ExpireCacheSessionService $expireCacheSession;
    private SessionRepositoryInterface $sessionRepository;

    public function __construct
    (
        ExpireCacheSessionService $expireCacheSession,
        SessionRepositoryInterface $sessionRepository
    ) {
        $this->expireCacheSession = $expireCacheSession;
        $this->sessionRepository = $sessionRepository;
    }

    public function expireSession(Session $session): void
    {
        $session->expire();
        $this->expireCacheSession->execute($session);
    }

    public function expireUserSessions(User $user): void
    {
        $sessions = $this->sessionRepository->getAllByUser($user);

        /* @var Session $session */
        foreach ($sessions as $session) {
            if (!$session->isExpired()) {
                $this->expireSession($session);
            }
        }

        $this->sessionRepository->update();
    }
}
