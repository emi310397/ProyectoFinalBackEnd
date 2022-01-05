<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\User;

use Application\Queries\User\GetCurrentUserQuery;
use Domain\Adapters\CommandAdapter;
use Illuminate\Http\Request;

class GetCurrentUserAdapter extends CommandAdapter
{
    public function adapt(Request $request): GetCurrentUserQuery
    {
        return new GetCurrentUserQuery();
    }
}
