<?php

declare(strict_types=1);

namespace Domain\Enums;

use Common\utils\Enum;

class TokenTypes extends Enum
{
    public const ACCOUNT_REGISTER = 1;
    public const ACCOUNT_RECOVERY = 2;
    public const MODIFY_EMAIL = 3;
}
