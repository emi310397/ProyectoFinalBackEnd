<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Domain\Enums\TokenTypes;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class Token
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    public const EXPIRATION_TIME = '-30 days';

    private User $user;
    private string $hash;
    private int $type;
    private bool $expired = false;

    public function __construct(User $user, string $hash)
    {
        $this->user = $user;
        $this->hash = $hash;
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function setHash(string $hash): void
    {
        $this->hash = $hash;
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

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function isRegisterType(): bool
    {
        return ($this->getType() === TokenTypes::ACCOUNT_REGISTER);
    }

    public function isRecoveryPasswordType(): bool
    {
        return ($this->getType() === TokenTypes::ACCOUNT_RECOVERY);
    }

    public function isModifyEmailType(): bool
    {
        return ($this->getType() === TokenTypes::MODIFY_EMAIL);
    }
}
