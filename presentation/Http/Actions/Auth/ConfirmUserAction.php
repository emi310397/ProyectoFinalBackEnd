<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Auth;

use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Auth\ConfirmUserAdapter;
use Presentation\Http\Presenters\Auth\ConfirmUserPresenter;

class ConfirmUserAction extends BaseAction
{
    public const ROUTE_NAME = 'User.confirm';

    private ConfirmUserAdapter $adapter;
    private CommandBusInterface $commandBus;
    private ConfirmUserPresenter $presenter;

    public function __construct(
        ConfirmUserAdapter $adapter,
        CommandBusInterface $commandBus,
        ConfirmUserPresenter $presenter
    ) {
        $this->adapter = $adapter;
        $this->commandBus = $commandBus;
        $this->presenter = $presenter;
    }

    public function execute(Request $request): JsonResponse
    {
        $command = $this->adapter->adapt($request);
        $result = $this->commandBus->handle($command);

        return $this->respondWithSuccess(
            [$this->presenter->fromResult($result)->getData()]
        );
    }
}
