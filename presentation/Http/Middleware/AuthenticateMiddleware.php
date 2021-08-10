<?php

declare(strict_types=1);

namespace Presentation\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class AuthenticateMiddleware
{
    public function handle(Request $request, Closure $next, ?string $guard = null)
    {
        return $next($request);
    }
}
