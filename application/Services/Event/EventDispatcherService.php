<?php

declare(strict_types=1);

namespace Application\Services\Event;

use Application\Events\Event;

class EventDispatcherService implements EventDispatcherServiceInterface
{
    public function handle(Event $event): void
    {
        event($event);
    }
}
