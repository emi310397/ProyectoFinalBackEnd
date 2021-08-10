<?php

declare(strict_types=1);

namespace Application\Commands\PClass;

use Domain\CommandBus\CommandInterface;

class CreatePClassCommand implements CommandInterface
{
    private string $subject;
    private string $description;

    public function __construct(string $subject, string $description)
    {
        $this->subject = $subject;
        $this->description = $description;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
