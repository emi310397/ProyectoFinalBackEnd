<?php

namespace Presentation\Http\Services;

use Domain\Entities\Session;
use Infrastructure\Interfaces\RedisClientInterface;
use Presentation\Http\Enums\RedisExpirationTimes;

class ExpireCacheSessionService
{
    private RedisClientInterface $redisClientProvider;

    public function __construct(RedisClientInterface $redisClientProvider)
    {
        $this->redisClientProvider = $redisClientProvider;
    }

    public function execute(Session $session): void
    {
        $client = $this->redisClientProvider->getClient();
        $client->expire($session->getHash(), RedisExpirationTimes::REDIS_EXPIRE_NOW);
    }
}
