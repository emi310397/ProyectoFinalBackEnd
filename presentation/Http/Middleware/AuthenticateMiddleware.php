<?php

declare(strict_types=1);

namespace Presentation\Http\Middleware;

use Application\ValueObjects\HttpStatusCode;
use Closure;
use Domain\Entities\Session;
use Domain\Interfaces\CurrentUserInterface;
use Domain\Interfaces\Repositories\SessionRepositoryInterface;
use Domain\Interfaces\Repositories\UserRepositoryInterface;
use Domain\Services\CreateSessionService;
use Illuminate\Http\Request;
use Infrastructure\Interfaces\RedisClientInterface;
use Presentation\Http\Enums\HttpHeaders;

final class AuthenticateMiddleware
{
    private CurrentUserInterface $currentUser;
    private SessionRepositoryInterface $sessionRepository;
    private UserRepositoryInterface $userRepository;
    private RedisClientInterface $redisClientProvider;
    private CreateSessionService $createSessionService;

    public function __construct(
        CurrentUserInterface $currentUser,
        SessionRepositoryInterface $sessionRepository,
        UserRepositoryInterface $userRepository,
        RedisClientInterface $redisClientProvider,
        CreateSessionService $createSessionService
    ) {
        $this->currentUser = $currentUser;
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
        $this->redisClientProvider = $redisClientProvider;
        $this->createSessionService = $createSessionService;
    }

    public function handle(Request $request, Closure $next, ?string $guard = null)
    {
        $hash = $request->header(HttpHeaders::AUTHORIZATION);

        if (empty($hash)) {
            abort(HttpStatusCode::UNAUTHORIZED);
        }

        $client = $this->redisClientProvider->getClient();
        $cacheSession = $client->get($hash);

        if (!$cacheSession) {
            $session = $this->sessionRepository->getByHash($hash);

            if (!$session) {
                abort(HttpStatusCode::UNAUTHORIZED);
            }

            if (!$session->isExpired()) {
                $this->createSessionService->cacheSession(
                    $session->getHash(),
                    $session->getUser()->getId(),
                    $session->getUpdatedAt()
                );
            }
        } else {
            $cacheSession = json_decode($cacheSession, true, 512, JSON_THROW_ON_ERROR);
            $user = $this->userRepository->getByIdOrFail($cacheSession['userId']);
            $session = new Session($user, $hash);
        }

        $this->currentUser->setUser($session->getUser());
        $request->attributes->set('user', $session->getUser());

        if ($session->isExpired()) {
            abort(HttpStatusCode::UNAUTHORIZED);
        }

        if (!$session->getUser()->isActivated()) {
            abort(HttpStatusCode::FORBIDDEN);
        }

        return $next($request);
    }
}
