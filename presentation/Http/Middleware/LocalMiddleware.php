<?php

declare(strict_types=1);

namespace Presentation\Http\Middleware;

use Application\ValueObjects\HttpStatusCode;
use Closure;

final class LocalMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (config('app.env') !== 'local'){
            abort(HttpStatusCode::NOT_FOUND);
        }

        return $next($request);
    }
}
