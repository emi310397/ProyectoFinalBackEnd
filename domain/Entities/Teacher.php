<?php

declare(strict_types=1);

namespace Domain\Entities;

use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class Teacher
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;
}
