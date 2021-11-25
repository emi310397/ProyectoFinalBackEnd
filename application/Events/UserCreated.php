<?php

declare(strict_types=1);

namespace Application\Events;

class UserCreated extends Event
{
    private string $email;
    private string $confirmationUrl;
    private string $hash;

    public function __construct(string $email, string $confirmationUrl, string $hash)
    {
        $this->email = $email;
        $this->confirmationUrl = $confirmationUrl;
        $this->hash = $hash;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getConfirmationUrl(): string
    {
        return $this->confirmationUrl;
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}
