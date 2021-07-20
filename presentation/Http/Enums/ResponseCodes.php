<?php
declare(strict_types=1);

namespace Presentation\Http\Enums;

class ResponseCodes
{
    public const CODE_WRONG_ARGS = 'WRONG-ARGS';
    public const CODE_NOT_FOUND = 'NOT-FOUND';
    public const CODE_CONFLICT = 'CONFLICT';
    public const CODE_METHOD_NOT_ALLOWED = 'METHOD-NOT-ALLOWED';
    public const CODE_INTERNAL_ERROR = 'ERROR';
    public const CODE_UNAUTHORIZED = 'UNAUTHORIZED';
    public const CODE_FORBIDDEN = 'FORBIDDEN';
    public const CODE_SUCCESS = 'OK';
    public const CODE_CREATED = 'CREATED';
    public const LOGIN_TIMEOUT = 'LOGIN-TIMEOUT';
}
