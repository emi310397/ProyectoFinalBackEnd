<?php

declare(strict_types=1);

namespace Domain\Entities;

use DateTime;
use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class Student
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

    public function __construct()
    {
        $timestamp = new DateTime();
        $this->setCreatedAt($timestamp);
        $this->setUpdatedAt($timestamp);
    }
}
