<?php

declare(strict_types=1);

namespace Application\Results\User;

use Domain\Entities\User;

class UserResult
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
