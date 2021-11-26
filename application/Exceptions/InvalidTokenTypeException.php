<?php

declare(strict_types=1);

namespace Application\Exceptions;

class InvalidTokenTypeException extends DomainRuntimeException
{
    public function __construct()
    {
        parent::__construct('The provided token is invalid.');
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getResponseMessage(): string
    {
        return $this->message;
    }
}
