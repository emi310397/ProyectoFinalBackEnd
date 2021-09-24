<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Domain\Traits\IdentityTrait;

class Teacher extends User
{
    use IdentityTrait;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ) {
        parent::__construct($firstName, $lastName, $email, $password);
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }
}
