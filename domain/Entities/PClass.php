<?php

declare(strict_types=1);

namespace Domain\Entities;

use Domain\Traits\IdentityTrait;
use Domain\Traits\SoftDeleteTrait;
use Domain\Traits\TimestampsTrait;

class PClass
{
    use SoftDeleteTrait;
    use TimestampsTrait;
    use IdentityTrait;

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

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
