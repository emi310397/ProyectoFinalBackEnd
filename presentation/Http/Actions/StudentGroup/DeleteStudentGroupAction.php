<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\StudentGroup;

use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\StudentGroup\DeleteStudentGroupAdapter;

class DeleteStudentGroupAction extends BaseAction
{
    public const ROUTE_NAME = 'StudentGroup.delete';

    private DeleteStudentGroupAdapter $adapter;
    private CommandBusInterface $commandBus;

    public function __construct(
        DeleteStudentGroupAdapter $adapter,
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
