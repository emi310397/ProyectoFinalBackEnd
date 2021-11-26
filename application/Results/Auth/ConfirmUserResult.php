<?php

declare(strict_types=1);

namespace Application\Results\Auth;

use Domain\Entities\Session;

class ConfirmUserResult
{
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getSession(): Session
    {
        return $this->session;
    }
}
