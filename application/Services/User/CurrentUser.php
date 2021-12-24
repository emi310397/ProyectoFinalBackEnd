<?php

declare(strict_types=1);

namespace Application\Services\User;

use Domain\Entities\User;
use Domain\Interfaces\CurrentUserInterface;

final class CurrentUser implements CurrentUserInterface
{
    private User $user;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
