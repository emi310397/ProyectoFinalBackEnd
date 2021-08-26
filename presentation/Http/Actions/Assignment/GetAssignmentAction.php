<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Assignment;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Assignment\GetAssignmentAdapter;
use Presentation\Http\Presenters\Assignment\AssignmentPresenter;

class GetAssignmentAction extends BaseAction
{
    public const ROUTE_NAME = 'Assignment.get';

    private GetAssignmentAdapter $adapter;
    private QueryBusInterface $queryBus;
    private AssignmentPresenter $presenter;

    public function __construct(
        GetAssignmentAdapter $adapter,
        QueryBusInterface $queryBus,
        AssignmentPresenter $presenter
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
