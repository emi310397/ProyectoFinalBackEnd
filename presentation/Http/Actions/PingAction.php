<?php

declare(strict_types=1);

namespace Presentation\Http\Actions;

use Application\ValueObjects\HttpStatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PingAction extends BaseAction
{
    public const ROUTE_NAME = 'Ping.get';

    public function execute(Request $request): JsonResponse
    {
        return new JsonResponse(
            'Pong',
            HttpStatusCode::OK,
            $request->attributes->get('newSession')
        );
    }
}
