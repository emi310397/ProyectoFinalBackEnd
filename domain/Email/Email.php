<?php

declare(strict_types=1);

namespace Domain\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class Email extends Mailable
{
    use Queueable, SerializesModels;

    abstract public function build();
}
