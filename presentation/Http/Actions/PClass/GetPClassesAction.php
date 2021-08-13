<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\PClass;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\PClass\GetPClassesAdapter;
use Presentation\Http\Presenters\PClass\PClassesPresenter;

class GetPClassesAction extends BaseAction
{
    public const ROUTE_NAME = 'PClasses.get';

    private GetPClassesAdapter $adapter;
    private QueryBusInterface $queryBus;
    private PClassesPresenter $presenter;

    public function __construct(
        GetPClassesAdapter $adapter,
        QueryBusInterface $queryBus,
        PClassesPresenter $presenter
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
