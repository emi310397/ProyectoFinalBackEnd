<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Auth;

use Application\Commands\Auth\LoginUserCommand;
use Application\Exceptions\DomainException;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class LoginUserAdapter extends CommandAdapter
{
    private const EMAIL_PARAM = 'email';
    private const PASSWORD_PARAM = 'password';

    private UserRepositoryInterface $userRepository;

    public function getRules(): array
    {
        return [
            self::EMAIL_PARAM => 'bail|required|email',
            self::PASSWORD_PARAM => 'bail|required',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::EMAIL_PARAM . '.required' => __('The Email is required'),
            self::EMAIL_PARAM . '.email' => __('The Email is not correct'),
            self::PASSWORD_PARAM . '.required' => __('The password is required'),
        ];
    }

    public function __construct(
        ValidatorServiceInterface $validator,
        UserRepositoryInterface $userRepository
    ) {
        parent::__construct($validator);
        $this->userRepository = $userRepository;
    }

    public function adapt(Request $request): LoginUserCommand
    {
        $this->assertRulesAreValid($request->all());

        $user = $this->userRepository->getByEmail($request->get(self::EMAIL_PARAM));

        if (!$user) {
            throw new DomainException(__('Wrong email or password'));
        }

        return new LoginUserCommand(
            $user,
            $request->get(self::PASSWORD_PARAM)
        );
    }
}
