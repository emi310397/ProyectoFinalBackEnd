<?php

declare(strict_types=1);

namespace Presentation\Http\Middleware;

use Application\Exceptions\AccessDeniedException;
use Closure;
use Domain\Interfaces\CurrentUserInterface;

class CheckRoleMiddleware
{
    private CurrentUserInterface $currentUser;

    public function __construct(CurrentUserInterface $currentUser)
    {
        $this->currentUser = $currentUser;
    }

    public function handle($request, Closure $next, ...$roles)
    {
        $user = $this->currentUser->getUser();

        if (!$user) {
            throw new AccessDeniedException(__('The user is not logged in'));
        }

        $hasRole = false;
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                $hasRole = true;
                break;
            }
        }

        if (!$hasRole) {
            throw new AccessDeniedException(__('The role of the user is not valid'));
        }

        return $next($request);
    }
}
