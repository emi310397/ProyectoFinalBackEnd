<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\StudentGroup;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\StudentGroup\GetStudentsGroupAdapter;
use Presentation\Http\Presenters\StudentGroup\StudentGroupsPresenter;

class GetStudentGroupsAction extends BaseAction
{
    public const ROUTE_NAME = 'StudentGroup.getMany';

    private GetStudentsGroupAdapter $adapter;
    private QueryBusInterface $queryBus;
    private StudentGroupsPresenter $presenter;

    public function __construct(
        GetStudentsGroupAdapter $adapter,
        QueryBusInterface       $queryBus,
        StudentGroupsPresenter  $presenter
    )
    {
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
