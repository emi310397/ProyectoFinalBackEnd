<?php

declare(strict_types=1);

namespace Infrastructure\Interfaces;

interface CookieableInterface
{
    public function toCookie();
}
