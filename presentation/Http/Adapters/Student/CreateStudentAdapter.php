<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Student;

use Application\Commands\Student\CreateStudentCommand;
use Application\Exceptions\ExistingEntityException;
use Domain\Adapters\CommandAdapter;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class CreateStudentAdapter extends CommandAdapter
{
    private UserRepositoryInterface $userRepository;

    private const FIRST_NAME_PARAM = 'firstName';
    private const LAST_NAME_PARAM = 'lastName';
    private const EMAIL_PARAM = 'email';
    private const PASSWORD_PARAM = 'password';
    private const CONFIRMATION_URL_PARAM = 'confirmationUrl';

    public function __construct(
        ValidatorServiceInterface $validator,
        UserRepositoryInterface $userRepository
    ) {
        parent::__construct($validator);
        $this->userRepository = $userRepository;
    }

    public function getRules(): array
    {
        return [
            self::FIRST_NAME_PARAM => 'bail|required|string',
            self::LAST_NAME_PARAM => 'bail|required|string',
            self::EMAIL_PARAM => 'bail|required|email|string',
            self::PASSWORD_PARAM => 'bail|required|string',
            self::CONFIRMATION_URL_PARAM => 'bail|required|url',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::FIRST_NAME_PARAM . 'required' => __('The user first name is required'),
            self::FIRST_NAME_PARAM . 'string' => __('The user first name must be a string'),
            self::LAST_NAME_PARAM . 'required' => __('The user last name is required'),
            self::LAST_NAME_PARAM . 'string' => __('The user last name must be a string'),
            self::EMAIL_PARAM . 'required' => __('The user email is required'),
            self::EMAIL_PARAM . 'email' => __('The user email must be a string'),
            self::EMAIL_PARAM . 'string' => __('The user email must is not valid'),
            self::PASSWORD_PARAM . 'required' => __('The user password is required'),
            self::PASSWORD_PARAM . 'string' => __('The user password must be a string'),
            self::CONFIRMATION_URL_PARAM . 'required' => __('The confirmation url is required'),
            self::CONFIRMATION_URL_PARAM . 'url' => __('The confirmation url must be a valid url'),
        ];
    }

    public function adapt(Request $request): CreateStudentCommand
    {
        $this->assertRulesAreValid($request->all());

        $email = $request->get(self::EMAIL_PARAM);

        $user = $this->userRepository->getByEmail($email);

        if ($user) {
            throw new ExistingEntityException(User::class);
        }

        return new CreateStudentCommand(
            $request->get(self::FIRST_NAME_PARAM),
            $request->get(self::LAST_NAME_PARAM),
            $email,
            $request->get(self::PASSWORD_PARAM),
            $request->get(self::CONFIRMATION_URL_PARAM)
        );
    }
}
