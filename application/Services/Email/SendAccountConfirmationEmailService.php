<?php

namespace Application\Services\Email;

use Domain\Services\EmailDispatcherServiceInterface;
use Infrastructure\Email\AccountConfirmationEmail;

class SendAccountConfirmationEmailService
{
    private EmailDispatcherServiceInterface $emailDispatcherService;
    private const HASH_PARAM = '?hash=';

    public function __construct(
        EmailDispatcherServiceInterface $emailDispatcherService
    ) {
        $this->emailDispatcherService = $emailDispatcherService;
    }

    public function handle(string $emailToSend, string $confirmationUrl, string $hash): void
    {
        $endpoint = $confirmationUrl . self::HASH_PARAM . $hash;

        $email = new AccountConfirmationEmail($endpoint);
        $email->to($emailToSend)
            ->from(config('emails.mail_from.email'), config('emails.from.name'));

        $this->emailDispatcherService->dispatch($email);
    }
}
