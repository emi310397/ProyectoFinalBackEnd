<?php

declare(strict_types=1);

namespace Application\Commands\Auth;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\User;

class LoginUserCommand implements CommandInterface
{
    private User $user;
    private string $password;

    public function __construct
    (
        User $user,
        string $password
    ) {
        $this->user = $user;
        $this->password = $password;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
