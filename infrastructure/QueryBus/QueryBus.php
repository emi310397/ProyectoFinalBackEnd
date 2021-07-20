<?php

declare(strict_types=1);

namespace Infrastructure\QueryBus;

use Domain\QueryBus\QueryBusInterface;
use League\Tactician\CommandBus as TacticianCommandBus;

final class QueryBus extends TacticianCommandBus implements QueryBusInterface
{
    public function __construct($middleware)
    {
        parent::__construct($middleware);
    }
}
