<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\StudentGroup;

use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\StudentGroup\EditStudentGroupAdapter;

class EditStudentGroupAction extends BaseAction
{
    public const ROUTE_NAME = 'StudentGroup.edit';

    private EditStudentGroupAdapter $adapter;
    private CommandBusInterface $commandBus;

    public function __construct(
        EditStudentGroupAdapter $adapter,
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
