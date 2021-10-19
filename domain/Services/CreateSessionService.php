<?php

namespace Domain\Services;

use DateTime;
use Domain\Entities\Session;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\SessionRepositoryInterface;
use Firebase\JWT\JWT;
use Infrastructure\Interfaces\RedisClientInterface;
use Presentation\Http\Enums\RedisExpirationTimes;

class CreateSessionService
{
    private const USER_KEY = 'user';
    private const FIRST_NAME_KEY = 'firstName';
    private const LAST_NAME_KEY = 'lastName';
    private const EMAIL_KEY = 'email';
    private const ROLE_KEY = 'rol';
    private const CREATED_AT_KEY = 'created_at';
    private const JWT_KEY = 'JWT_KEY';

    private SessionRepositoryInterface $sessionRepository;
    private RedisClientInterface $redisClientProvider;

    public function __construct(
        SessionRepositoryInterface $sessionRepository,
        RedisClientInterface $redisClientProvider
    ) {
        $this->sessionRepository = $sessionRepository;
        $this->redisClientProvider = $redisClientProvider;
    }

    public function handle(User $user): Session
    {
        $hash = $this->generateJWTToken($user);
        $session = new Session($user, $hash);
        $this->sessionRepository->save($session);

        $this->cacheSession($hash, $user->getId(), new DateTime());

        return $session;
    }

    private function generateJWTToken(User $user): string
    {
        $payload = [
            self::USER_KEY => [
                self::FIRST_NAME_KEY => $user->getFirstName(),
                self::LAST_NAME_KEY => $user->getLastName(),
                self::EMAIL_KEY => $user->getEmail(),
                self::ROLE_KEY => get_class($user)
            ],
            self::CREATED_AT_KEY => new DateTime()
        ];

        return JWT::encode($payload, env(self::JWT_KEY));
    }

    public function cacheSession(string $hash, int $userId, DateTime $timestamp): void
    {
        $client = $this->redisClientProvider->getClient();
        $client->set(
            $hash,
            json_encode(
                [
                    'userId' => $userId,
                    'timestamp' => $timestamp->getTimestamp()
                ],
                JSON_THROW_ON_ERROR
            )
        );
        $client->expire($hash, RedisExpirationTimes::REDIS_EXPIRATION_TIME);
    }
}
