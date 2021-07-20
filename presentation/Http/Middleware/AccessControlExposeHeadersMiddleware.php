<?php

namespace Presentation\Http\Middleware;

use Closure;

class AccessControlExposeHeadersMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $headers = $response->headers->all();

        return $response->withHeaders(
            $headers + [
                'Access-Control-Expose-Headers' => 'newSession, newRenovateHash, spa-version'
            ]
        );
    }
}
