<?php

declare(strict_types=1);

namespace Domain\Entities;

use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class Session
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    public const EXPIRATION_TIME = '-30 days';

    private User $user;
    private string $hash;
    private bool $expired = false;

    public function __construct(User $user, string $hash)
    {
        $this->user = $user;
        $this->hash = $hash;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function expire(): void
    {
        $this->expired = true;
    }

    public function isExpired(): bool
    {
        if ($this->expired) {
            return true;
        }

        return (int)$this->getUpdatedAt()->format('U') < strtotime(self::EXPIRATION_TIME);
    }
}
