<?php

declare(strict_types=1);

namespace Domain\CommandBus;

interface CommandBusInterface
{
    public function handle($command);
}
