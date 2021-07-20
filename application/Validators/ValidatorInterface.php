<?php

declare(strict_types=1);

namespace Application\Validators;

use Domain\CommandBus\CommandInterface;

interface ValidatorInterface
{
    public function validate(CommandInterface $command);
}
