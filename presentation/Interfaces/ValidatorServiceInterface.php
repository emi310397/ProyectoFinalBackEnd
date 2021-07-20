<?php

declare(strict_types=1);

namespace Presentation\Interfaces;

use Illuminate\Contracts\Support\MessageBag;

interface ValidatorServiceInterface
{
    public function make(array $options, array $rules, array $messages = []);

    public function isValid(): bool;

    public function getErrors(): MessageBag;
}
