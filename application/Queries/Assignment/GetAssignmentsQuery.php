<?php

declare(strict_types=1);

namespace Application\Queries\Assignment;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\User;

class GetAssignmentsQuery implements CommandInterface
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
