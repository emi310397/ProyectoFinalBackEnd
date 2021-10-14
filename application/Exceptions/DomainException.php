<?php

declare(strict_types=1);

namespace Application\Exceptions;

use Application\ValueObjects\HttpStatusCode;
use Exception;

class DomainException extends Exception
{
    private int $statusCode;
    private string $responseMessage;

    public function __construct(string $responseMessage)
    {
        parent::__construct($responseMessage);
        $this->statusCode = HttpStatusCode::UNAUTHORIZED;
        $this->responseMessage = $responseMessage;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getResponseMessage(): string
    {
        return $this->responseMessage;
    }
}
