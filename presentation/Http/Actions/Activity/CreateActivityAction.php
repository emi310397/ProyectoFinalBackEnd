<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Activity;

use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Activity\CreateActivityAdapter;

class CreateActivityAction extends BaseAction
{
    public const ROUTE_NAME = 'Activity.create';

    private CreateActivityAdapter $adapter;
    private CommandBusInterface $commandBus;

    public function __construct(
        CreateActivityAdapter $adapter,
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
