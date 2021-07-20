<?php

declare(strict_types=1);

namespace Domain\Interfaces;

use Domain\Entities\User;

interface CurrentUserInterface
{
    public function setUser(User $user): void;

    public function getUser(): ?User;
}
