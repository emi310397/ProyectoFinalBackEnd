<?php

declare(strict_types=1);

namespace Domain\Enums;

use Common\utils\Enum;

class UserRoles extends Enum
{
    public const TEACHER = 'teacher';
    public const STUDENT = 'student';
}
