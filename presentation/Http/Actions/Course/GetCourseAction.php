<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Course;

use Domain\QueryBus\QueryBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Course\GetCourseAdapter;
use Presentation\Http\Presenters\Course\CoursePresenter;

class GetCourseAction extends BaseAction
{
    public const ROUTE_NAME = 'Course.get';

    private GetCourseAdapter $adapter;
    private QueryBusInterface $queryBus;
    private CoursePresenter $presenter;

    public function __construct(
        GetCourseAdapter $adapter,
        QueryBusInterface $queryBus,
        CoursePresenter $presenter
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
