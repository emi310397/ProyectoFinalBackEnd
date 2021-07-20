<?php

declare(strict_types=1);

namespace Infrastructure\Interfaces;

use Predis\Client;

interface RedisClientInterface
{
    public function setClient(Client $client): void;

    public function getClient(): Client;
}
