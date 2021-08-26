<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Course;

use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Course\EditCourseAdapter;

class EditCourseAction extends BaseAction
{
    public const ROUTE_NAME = 'Course.edit';

    private EditCourseAdapter $adapter;
    private CommandBusInterface $commandBus;

    public function __construct(
        EditCourseAdapter $adapter,
        CommandBusInterface $commandBus
    ) {
        $this->adapter = $adapter;
        $this->commandBus = $commandBus;
    }

    public function execute(Request $request): JsonResponse
    {
        $command = $this->adapter->adapt($request);
        $this->commandBus->handle($command);

        return $this->respondWithSuccess(
            []
        );
    }
}
