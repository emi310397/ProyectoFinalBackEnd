<?php

declare(strict_types=1);

namespace Presentation\Interfaces;

use Illuminate\Http\Request;

interface CurrentRequestInterface
{
    public function getRequest(): ?Request;

    public function setRequest(Request $request): void;
}
