<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Auth;

use Domain\CommandBus\CommandBusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Actions\BaseAction;
use Presentation\Http\Adapters\Auth\LoginUserAdapter;
use Presentation\Http\Presenters\Auth\LoginUserPresenter;

class LoginUserAction extends BaseAction
{
    public const ROUTE_NAME = "Auth.user_login";

    private LoginUserAdapter $loginUserAdapter;
    private CommandBusInterface $commandBus;
    private LoginUserPresenter $loginUserPresenter;

    public function __construct(
        LoginUserAdapter $loginUserAdapter,
        CommandBusInterface $commandBus,
        LoginUserPresenter $loginUserPresenter
    ) {
        $this->loginUserAdapter = $loginUserAdapter;
        $this->commandBus = $commandBus;
        $this->loginUserPresenter = $loginUserPresenter;
    }

    public function execute(Request $request): JsonResponse
    {
        $command = $this->loginUserAdapter->adapt($request);
        $result = $this->commandBus->handle($command);

        return $this->respondWithSuccess(
            $this->loginUserPresenter->fromResult($result)->getData()
        );
    }
}
