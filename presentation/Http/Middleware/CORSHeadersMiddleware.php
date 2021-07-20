<?php

namespace Presentation\Http\Middleware;

use Closure;

class CORSHeadersMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $headers = $response->headers->all();

        return $response->withHeaders($headers + [
            'Access-Control-Allow-Origin' => config('cors.CORS_ORIGIN'),
            'Access-Control-Allow-Headers' => config('cors.CORS_HEADER'),
            'Access-Control-Allow-Methods' => config('cors.CORS_METHODS')
        ]);
    }
}
