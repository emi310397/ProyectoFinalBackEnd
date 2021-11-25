<?php

declare(strict_types=1);

namespace Application\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class Event
{
    use SerializesModels;
    use Dispatchable;
}
