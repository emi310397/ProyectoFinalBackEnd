<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Auth;

use Application\Commands\Auth\LogoutUserCommand;
use Domain\Adapters\CommandAdapter;
use Illuminate\Http\Request;
use Presentation\Http\Enums\HttpHeaders;

class LogoutUserAdapter extends CommandAdapter
{
    public function adapt(Request $request): LogoutUserCommand
    {
        $hash = $request->header(HttpHeaders::AUTHORIZATION);

        return new LogoutUserCommand($hash);
    }
}
