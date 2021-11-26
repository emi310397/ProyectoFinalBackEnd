<?php

declare(strict_types=1);

namespace Application\Validators\Auth;

use Application\Exceptions\DomainRuntimeException;
use Application\Exceptions\InvalidTokenTypeException;
use Domain\Entities\Token;

class TokenValidator
{
    private Token $token;

    public function fromCommand(Token $token): TokenValidator
    {
        $this->token = $token;
        return $this;
    }

    public function validateWithType(int $type): void
    {
        $token = $this->token;

        if ($token->isExpired()) {
            throw new DomainRuntimeException(__('Token has expired'));
        }

        if ($this->token->getType() !== $type) {
            throw new InvalidTokenTypeException();
        }
    }
}
