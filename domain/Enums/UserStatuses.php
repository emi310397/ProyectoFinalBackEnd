<?php

declare(strict_types=1);

namespace Domain\Enums;

use Common\utils\Enum;

class UserStatuses extends Enum
{
    public const NOT_ACTIVATED = 0;
    public const ACTIVATED = 1;
    public const DISABLED = 3;
}
