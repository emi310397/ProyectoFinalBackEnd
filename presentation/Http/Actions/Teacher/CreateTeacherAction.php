<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Teacher;

use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Teacher\CreateTeacherAdapter;

class CreateTeacherAction extends BaseAction
{
    public const ROUTE_NAME = 'Teacher.create';

    private CreateTeacherAdapter $adapter;
    private CommandBusInterface $commandBus;

    public function __construct(
        CreateTeacherAdapter $adapter,
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
