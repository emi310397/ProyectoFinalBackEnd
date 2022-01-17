<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\User;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\User\GetCurrentUserAdapter;
use Presentation\Http\Presenters\User\UserPresenter;

class GetCurrentUserAction extends BaseAction
{
    public const ROUTE_NAME = 'User.get';

    private GetCurrentUserAdapter $adapter;
    private QueryBusInterface $queryBus;
    private UserPresenter $presenter;

    public function __construct(
        GetCurrentUserAdapter $adapter,
        QueryBusInterface $queryBus,
        UserPresenter $presenter
    ) {
        $this->adapter = $adapter;
        $this->queryBus = $queryBus;
        $this->presenter = $presenter;
    }

    public function execute(Request $request): JsonResponse
    {
        $query = $this->adapter->adapt($request);
        $result = $this->queryBus->handle($query);

        return $this->respondWithSuccess(
            $this->presenter->fromResult($result)->getData()
        );
    }
}
