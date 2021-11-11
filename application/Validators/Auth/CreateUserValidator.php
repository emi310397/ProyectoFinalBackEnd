<?php

declare(strict_types=1);

namespace Application\Validators\Auth;

use Application\Exceptions\DomainException;
use Domain\Interfaces\Repositories\UserRepositoryInterface;

class CreateUserValidator
{
    private UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function validate(string $email): void
    {
        $existentUser = $this->userRepository->getByEmail($email);

        if ($existentUser) {
            throw new DomainException(__('There is already an user with that email address'));
        }
    }
}
