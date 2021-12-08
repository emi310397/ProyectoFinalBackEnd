<?php

declare(strict_types=1);

namespace Application\Commands\Student;

use Domain\CommandBus\CommandInterface;

class CreateStudentCommand implements CommandInterface
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private string $confirmationUrl;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $confirmationUrl
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->confirmationUrl = $confirmationUrl;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getConfirmationUrl(): string
    {
        return $this->confirmationUrl;
    }
}
