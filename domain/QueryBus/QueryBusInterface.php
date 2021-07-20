<?php

declare(strict_types=1);

namespace Domain\QueryBus;

interface QueryBusInterface
{
    public function handle($command);
}
