<?php

declare(strict_types=1);

namespace Presentation\Exceptions;

use Application\ValueObjects\HttpStatusCode;
use RuntimeException;

class InvalidParamException extends RuntimeException
{
    public function __construct(string $message)
    {
        parent::__construct($message, HttpStatusCode::UNPROCESSABLE_ENTITY);
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getResponseMessage()
    {
        return $this->message;
    }

}
