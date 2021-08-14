<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Task;

use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Task\CreateTaskAdapter;

class CreateTaskAction extends BaseAction
{
    public const ROUTE_NAME = 'Task.create';

    private CreateTaskAdapter $adapter;
    private CommandBusInterface $commandBus;

    public function __construct(
        CreateTaskAdapter $adapter,
        CommandBusInterface $commandBus
    ) {
        $this->adapter = $adapter;
        $this->commandBus = $commandBus;
    }

    public function execute(Request $request): JsonResponse
    {
        $command = $this->adapter->adapt($request);
        $this->commandBus->handle($command);

        return $this->respondWithCreated(
            []
        );
    }
}
