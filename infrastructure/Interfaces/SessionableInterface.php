<?php

declare(strict_types=1);

namespace Infrastructure\Interfaces;

interface SessionableInterface
{
    public function toSession(string $arg);
}
