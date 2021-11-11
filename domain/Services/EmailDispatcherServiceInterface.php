<?php

declare(strict_types=1);

namespace Domain\Services;

use Domain\Email\Email;

interface EmailDispatcherServiceInterface
{
    public function dispatch(Email $email): void;
}
