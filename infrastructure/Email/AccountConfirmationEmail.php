<?php

declare(strict_types=1);

namespace Infrastructure\Email;

use Domain\Email\Email;

class AccountConfirmationEmail extends Email
{
    private string $link;

    public function __construct(string $link)
    {
        $this->link = $link;
    }

    public function build(): AccountConfirmationEmail
    {
        return $this->view('email.confirm_account')
            ->subject('Confirm your account')
            ->with(['link' => $this->link]);
    }
}
