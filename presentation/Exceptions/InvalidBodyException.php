<?php

declare(strict_types=1);

namespace Presentation\Exceptions;

use Exception;

class InvalidBodyException extends Exception
{
    private array $errors;

    public function __construct(array $errors = [])
    {
        parent::__construct();

        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
