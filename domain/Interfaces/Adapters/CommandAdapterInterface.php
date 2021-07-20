<?php

declare(strict_types=1);

namespace Domain\Interfaces\Adapters;

use Domain\CommandBus\CommandInterface;
use Illuminate\Http\Request;

interface CommandAdapterInterface
{
    public function adapt(Request $request): CommandInterface;
}
