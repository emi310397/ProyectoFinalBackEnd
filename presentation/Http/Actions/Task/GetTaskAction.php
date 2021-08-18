<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Task;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Task\GetTaskAdapter;
use Presentation\Http\Presenters\Task\TaskPresenter;

class GetTaskAction extends BaseAction
{
    public const ROUTE_NAME = 'Task.get';

    private GetTaskAdapter $adapter;
    private QueryBusInterface $queryBus;
    private TaskPresenter $presenter;

    public function __construct(
        GetTaskAdapter $adapter,
        QueryBusInterface $queryBus,
        TaskPresenter $presenter
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
