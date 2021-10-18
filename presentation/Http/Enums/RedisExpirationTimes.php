<?php

declare(strict_types=1);

namespace Presentation\Http\Enums;

use Common\utils\Enum;

class RedisExpirationTimes extends Enum
{
    public const REDIS_EXPIRATION_TIME = 7200;
    public const REDIS_EXPIRE_NOW = 0;
}
