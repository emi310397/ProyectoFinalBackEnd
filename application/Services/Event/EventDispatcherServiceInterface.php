<?php

declare(strict_types=1);

namespace Application\Services\Event;

use Application\Events\Event;

interface EventDispatcherServiceInterface
{
    public function handle(Event $event): void;
}
