<?php

declare(strict_types=1);

namespace Domain\Entities;

class Student extends User
{
    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ) {
        parent::__construct($firstName, $lastName, $email, $password);
    }
}
