<?php

declare(strict_types=1);

namespace Application\Results\Auth;

use Domain\Entities\Session;

class LoginUserResult
{
    private Session $session;
    private int $userStatus;

    public function __construct(int $userStatus, Session $session)
    {
        $this->session = $session;
        $this->userStatus = $userStatus;
    }

    public function getSession(): Session
    {
        return $this->session;
    }

    public function getUserStatus(): int
    {
        return $this->userStatus;
    }
}
