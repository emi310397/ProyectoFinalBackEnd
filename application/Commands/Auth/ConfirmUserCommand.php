<?php

declare(strict_types=1);

namespace Application\Commands\Auth;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\Token;

class ConfirmUserCommand implements CommandInterface
{
    private Token $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function getToken(): Token
    {
        return $this->token;
    }
}
