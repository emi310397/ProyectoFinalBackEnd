<?php

declare(strict_types=1);

namespace Application\Results\PClass;

class PClassesResult
{
    private array $PClassesResults;

    public function __construct(array $PClassesResults)
    {
        $this->PClassesResults = $PClassesResults;
    }

    public function getPClassesResults(): array
    {
        return $this->PClassesResults;
    }
}
