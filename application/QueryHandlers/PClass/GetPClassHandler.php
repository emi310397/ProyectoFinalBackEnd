<?php

declare(strict_types=1);

namespace Application\QueryHandlers\PClass;

use Application\Queries\PClass\GetPClassQuery;
use Application\Results\PClass\PClassResult;

class GetPClassHandler
{
    public function handle(GetPClassQuery $command): PClassResult
    {
        return new PClassResult($command->getPClass());
    }
}
