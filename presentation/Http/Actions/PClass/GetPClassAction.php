<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\PClass;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\PClass\GetPClassAdapter;
use Presentation\Http\Presenters\PClass\PClassPresenter;

class GetPClassAction extends BaseAction
{
    public const ROUTE_NAME = 'PClass.get';

    private GetPClassAdapter $adapter;
    private QueryBusInterface $queryBus;
    private PClassPresenter $presenter;

    public function __construct(
        GetPClassAdapter $adapter,
        QueryBusInterface $queryBus,
        PClassPresenter $presenter
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
