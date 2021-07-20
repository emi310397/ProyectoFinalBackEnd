<?php

declare(strict_types=1);

namespace Presentation\Http\Enums;

use Common\utils\Enum;

class HttpMethods extends Enum
{
    public const GET = 'get';
    public const POST = 'post';
    public const PUT = 'put';
    public const DELETE = 'delete';
}
