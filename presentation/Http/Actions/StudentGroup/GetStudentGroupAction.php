<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\StudentGroup;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\StudentGroup\GetStudentGroupAdapter;
use Presentation\Http\Presenters\StudentGroup\StudentGroupPresenter;

class GetStudentGroupAction extends BaseAction
{
    public const ROUTE_NAME = 'StudentGroup.get';

    private GetStudentGroupAdapter $adapter;
    private QueryBusInterface $queryBus;
    private StudentGroupPresenter $presenter;

    public function __construct(
        GetStudentGroupAdapter $adapter,
        QueryBusInterface $queryBus,
        StudentGroupPresenter $presenter
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
