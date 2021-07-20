<?php

declare(strict_types=1);

namespace Infrastructure\Interfaces;

interface JsonableInterface
{
    /**
     * Returns a JSON representation of current object
     *
     * @return string
     */
    public function toJson(): string;
}
