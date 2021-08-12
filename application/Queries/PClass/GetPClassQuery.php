<?php

declare(strict_types=1);

namespace Application\Queries\PClass;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\PClass;

class GetPClassQuery implements CommandInterface
{
    private PClass $PClass;

    public function __construct(PClass $PClass)
    {
        $this->PClass = $PClass;
    }

    public function getPClass(): PClass
    {
        return $this->PClass;
    }
}
