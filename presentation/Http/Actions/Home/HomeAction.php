<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Home;

use Illuminate\Http\JsonResponse;
use Presentation\Http\Actions\BaseAction;

final class HomeAction extends BaseAction
{
    public const ROUTE_NAME = 'Home.index';

    public function execute(): JsonResponse
    {
        return $this->respondWithSuccess(
            [],
            __('Api works!')
        );
    }
}
