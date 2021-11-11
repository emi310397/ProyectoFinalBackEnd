<?php

declare(strict_types=1);

namespace Application\Listeners;

use Application\Events\UserCreated;
use Application\Services\Email\SendAccountConfirmationEmailService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAccountConfirmationEmailToUser implements ShouldQueue
{
    private SendAccountConfirmationEmailService $sendAccountConfirmationEmailService;

    public function __construct(
        SendAccountConfirmationEmailService $sendAccountConfirmationEmailService
    ) {
        $this->sendAccountConfirmationEmailService = $sendAccountConfirmationEmailService;
    }

    public function handle(UserCreated $event): void
    {
        $this->sendAccountConfirmationEmailService->handle(
            $event->getEmail(),
            $event->getConfirmationUrl(),
            $event->getHash()
        );
    }
}
