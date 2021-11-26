<?php

declare(strict_types=1);

namespace Application\Exceptions;

use Application\ValueObjects\HttpStatusCode;
use Exception;

class DomainRuntimeException extends Exception
{
    private int $statusCode;
    private string $responseMessage;

    public function __construct(string $responseMessage)
    {
        parent::__construct($responseMessage);
        $this->statusCode = HttpStatusCode::CONFLICT;
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
