<?php

declare(strict_types=1);

namespace Application\ValueObjects;

class HttpStatusCode
{
    public const OK = 200;
    public const CREATED = 201;
    public const ACCEPTED = 202;
    public const NO_CONTENT = 204;

    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const METHOD_NOT_ALLOWED = 405;
    public const CONFLICT = 409;
    public const PRECONDITION_FAILED = 412;
    public const UNPROCESSABLE_ENTITY = 422;
    public const LOGIN_TIMEOUT = 440;

    public const INTERNAL_ERROR = 500;
}
