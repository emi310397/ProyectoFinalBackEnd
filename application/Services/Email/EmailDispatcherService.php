<?php

declare(strict_types=1);

namespace Application\Services\Email;

use Domain\Email\Email;
use Domain\Services\EmailDispatcherServiceInterface;
use Illuminate\Support\Facades\Mail;

class EmailDispatcherService implements EmailDispatcherServiceInterface
{
    private const QUEUE_NAME = 'emails';

    public function dispatch(Email $email): void
    {
        Mail::queue($email, self::QUEUE_NAME);
    }
}
