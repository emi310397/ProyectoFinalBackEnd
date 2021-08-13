<?php

declare(strict_types=1);

namespace Application\Commands\PClass;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\PClass;

class EditPClassCommand implements CommandInterface
{
    private PClass $PClass;
    private ?string $subject;
    private ?string $description;

    public function __construct(PClass $PClass, ?string $subject, ?string $description)
    {
        $this->PClass = $PClass;
        $this->subject = $subject;
        $this->description = $description;
    }

    public function getPClass(): PClass
    {
        return $this->PClass;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
