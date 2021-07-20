<?php

declare(strict_types=1);

namespace Domain\Adapters;

use Domain\CommandBus\CommandInterface;
use Domain\Interfaces\Adapters\CommandAdapterInterface;
use Illuminate\Http\Request;
use Presentation\Exceptions\InvalidBodyException;
use Presentation\Interfaces\ValidatorServiceInterface;

abstract class CommandAdapter implements CommandAdapterInterface
{
    protected ValidatorServiceInterface $validator;

    public function __construct(ValidatorServiceInterface $validator)
    {
        $this->validator = $validator;
    }

    abstract public function adapt(Request $request): CommandInterface;

    protected function assertRulesAreValid(array $data): void
    {
        $this->validator->make($data, $this->getRules(), $this->getMessages());

        if (! $this->validator->isValid()) {
            throw new InvalidBodyException($this->validator->getErrors()->toArray());
        }
    }

    protected function getRules(): array
    {
        return [];
    }

    protected function getMessages(): array
    {
        return [];
    }
}
