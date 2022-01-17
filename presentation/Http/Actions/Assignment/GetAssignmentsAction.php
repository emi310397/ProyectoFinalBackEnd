<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Assignment;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\PClass\GetPClassesAdapter;
use Presentation\Http\Presenters\Assignment\AssignmentsPresenter;

class GetAssignmentsAction extends BaseAction
{
    public const ROUTE_NAME = 'Assignment.getMany';

    private GetPClassesAdapter $adapter;
    private QueryBusInterface $queryBus;
    private AssignmentsPresenter $presenter;

    public function __construct(
        GetPClassesAdapter $adapter,
        QueryBusInterface $queryBus,
        AssignmentsPresenter $presenter
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
