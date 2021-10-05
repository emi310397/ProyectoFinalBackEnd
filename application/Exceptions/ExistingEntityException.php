<?php

declare(strict_types=1);

namespace Application\Exceptions;

use Exception;

class ExistingEntityException extends Exception
{
    public function __construct(string $entity)
    {
        parent::__construct(strtr(':entity', [':entity' => $entity]));
    }
}
