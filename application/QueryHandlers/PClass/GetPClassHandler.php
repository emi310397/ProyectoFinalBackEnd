<?php

declare(strict_types=1);

namespace Application\QueryHandlers\PClass;

use Application\Queries\PClass\GetPClassQuery;
use Application\Results\PClass\PClassSingleResult;

class GetPClassHandler
{
    public function handle(GetPClassQuery $command): PClassSingleResult
    {
        return new PClassSingleResult($command->getPClass());
    }
}
