<?php

declare(strict_types=1);

namespace Application\Commands\Auth;

use Domain\CommandBus\CommandInterface;

class LogoutUserCommand implements CommandInterface
{
    private string $hash;

    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}
