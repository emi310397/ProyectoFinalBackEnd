<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Teacher;

use Application\Commands\Teacher\CreateTeacherCommand;
use Domain\Adapters\CommandAdapter;
use Illuminate\Http\Request;

class CreateTeacherAdapter extends CommandAdapter
{
    private const FIRST_NAME_PARAM = 'firstName';
    private const LAST_NAME_PARAM = 'lastName';
    private const EMAIL_PARAM = 'email';
    private const PASSWORD_PARAM = 'password';

    public function getRules(): array
    {
        return [
            self::FIRST_NAME_PARAM => 'bail|required|string',
            self::LAST_NAME_PARAM => 'bail|required|string',
            self::EMAIL_PARAM => 'bail|required|email|string',
            self::PASSWORD_PARAM => 'bail|required|string',
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
        ];
    }

    public function adapt(Request $request): CreateTeacherCommand
    {
        $this->assertRulesAreValid($request->all());

        return new CreateTeacherCommand(
            $request->get(self::FIRST_NAME_PARAM),
            $request->get(self::LAST_NAME_PARAM),
            $request->get(self::EMAIL_PARAM),
            $request->get(self::PASSWORD_PARAM)
        );
    }
}