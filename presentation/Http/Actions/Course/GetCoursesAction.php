<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Course;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Course\GetCoursesAdapter;
use Presentation\Http\Presenters\Course\CoursesPresenter;

class GetCoursesAction extends BaseAction
{
    public const ROUTE_NAME = 'Course.getMany';

    private GetCoursesAdapter $adapter;
    private QueryBusInterface $queryBus;
    private CoursesPresenter $presenter;

    public function __construct(
        GetCoursesAdapter $adapter,
        QueryBusInterface $queryBus,
        CoursesPresenter $presenter
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
