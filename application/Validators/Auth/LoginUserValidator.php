<?php

declare(strict_types=1);

namespace Application\Validators\Auth;

use Application\Commands\Auth\LoginUserCommand;
use Application\Exceptions\DomainException;
use Application\Services\Encrypt\EncryptService;

class LoginUserValidator
{
    private EncryptService $encryptService;

    public function __construct
    (
        EncryptService $encryptService
    ) {
        $this->encryptService = $encryptService;
    }

    public function validate(LoginUserCommand $command): void
    {
        if ($command->getUser()->isDisabled()) {
            throw new DomainException(__('The user is disabled'));
        }

        if ($command->getUser()->isNotActivated()) {
            throw new DomainException(__('The user is not activated'));
        }

        if (!$this->encryptService->comparePasswords($command->getPassword(), $command->getUser()->getPassword())) {
            throw new DomainException(__('Wrong email or password'));
        }
    }
}
