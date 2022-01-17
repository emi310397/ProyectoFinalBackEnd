<?php

declare(strict_types=1);

namespace Application\QueryHandlers\User;

use Application\Queries\User\GetCurrentUserQuery;
use Application\Results\User\UserResult;
use Domain\Interfaces\CurrentUserInterface;

class GetCurrentUserHandler
{
    private CurrentUserInterface $currentUser;

    public function __construct(CurrentUserInterface $currentUser)
    {
        $this->currentUser = $currentUser;
    }

    public function handle(GetCurrentUserQuery $query): UserResult
    {
        $currentUser = $this->currentUser->getUser();

        return new UserResult($currentUser);
    }
}
