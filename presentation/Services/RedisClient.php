<?php

declare(strict_types=1);

namespace Presentation\Services;

use Infrastructure\Interfaces\RedisClientInterface;
use Predis\Client;

final class RedisClient implements RedisClientInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(config('session.REDIS_CONNECTION'));
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }
}
