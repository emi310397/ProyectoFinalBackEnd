<?php

declare(strict_types=1);

namespace Presentation\Services;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Validation\Validator;
use Presentation\Interfaces\ValidatorServiceInterface;
use Illuminate\Validation\Factory;

class ValidatorService implements ValidatorServiceInterface
{
    private Factory $validatorFactory;
    private Validator $validator;

    public function __construct(Factory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function make(array $options, array $rules, array $messages = [])
    {
        $this->validator = $this->validatorFactory->make($options, $rules, $messages);
    }

    public function isValid(): bool
    {
        return false === $this->validator->fails();
    }

    public function getErrors(): MessageBag
    {
        return $this->validator->errors();
    }
}
