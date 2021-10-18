<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Domain\Enums\UserStatuses;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

abstract class User
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private int $status = UserStatuses::NOT_ACTIVATED;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }


    public function getStatus(): int
    {
        return $this->status;
    }

    public function isNotActivated(): bool
    {
        return $this->getStatus() === UserStatuses::NOT_ACTIVATED;
    }

    public function isActivated(): bool
    {
        return $this->getStatus() === UserStatuses::ACTIVATED;
    }

    public function isDisabled(): bool
    {
        return $this->getStatus() === UserStatuses::DISABLED;
    }

    public function activate(): void
    {
        $this->status = UserStatuses::ACTIVATED;
    }

    public function deactivate(): void
    {
        $this->status = UserStatuses::NOT_ACTIVATED;
    }

    public function disable(): void
    {
        $this->status = UserStatuses::DISABLED;
    }
}
