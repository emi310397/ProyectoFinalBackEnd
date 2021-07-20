<?php

declare(strict_types=1);

namespace Presentation\Exceptions;

use Application\ValueObjects\HttpStatusCode;
use Exception;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct($message = "", $code = HttpStatusCode::NOT_FOUND, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function fromClassNameAndIdentifier($className, array $id)
    {
        $ids = [];

        foreach ($id as $key => $value) {
            $ids[] = $key . '(' . $value . ')';
        }

        return new self(
            'Entity of type \'' . $className . '\'' . ($ids ? ' for IDs ' . implode(', ', $ids) : '') . ' was not found'
        );
    }
}
