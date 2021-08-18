<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Task;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Task\GetTasksAdapter;
use Presentation\Http\Presenters\Task\TasksPresenter;

class GetTasksAction extends BaseAction
{
    public const ROUTE_NAME = 'Tasks.get';

    private GetTasksAdapter $adapter;
    private QueryBusInterface $queryBus;
    private TasksPresenter $presenter;

    public function __construct(
        GetTasksAdapter $adapter,
        QueryBusInterface $queryBus,
        TasksPresenter $presenter
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
