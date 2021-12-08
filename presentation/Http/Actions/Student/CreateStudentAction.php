<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Student;

use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Student\CreateStudentAdapter;

class CreateStudentAction extends BaseAction
{
    public const ROUTE_NAME = 'Student.create';

    private CreateStudentAdapter $adapter;
    private CommandBusInterface $commandBus;

    public function __construct(
        CreateStudentAdapter $adapter,
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
