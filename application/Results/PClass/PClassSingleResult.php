<?php

declare(strict_types=1);

namespace Application\Results\PClass;

use Domain\Entities\PClass;

class PClassSingleResult
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
