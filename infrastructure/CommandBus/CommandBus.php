<?php

declare(strict_types=1);

namespace Infrastructure\CommandBus;

use Domain\CommandBus\CommandBusInterface;
use League\Tactician\CommandBus as TacticianCommandBus;

final class CommandBus extends TacticianCommandBus implements CommandBusInterface
{
    public function __construct($middleware)
    {
        parent::__construct($middleware);
    }
}
