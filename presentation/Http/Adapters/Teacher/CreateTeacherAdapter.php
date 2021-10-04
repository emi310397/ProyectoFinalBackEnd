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
            self::FIRST_NAME_PARAM . 'required' => __('The id of the class is required'),
            self::FIRST_NAME_PARAM . 'string' => __('The id of the class must be a number'),
            self::LAST_NAME_PARAM . 'required' => __('The title of the task is required'),
            self::LAST_NAME_PARAM . 'string' => __('The title of the task must be a string'),
            self::EMAIL_PARAM . 'required' => __('The description of the task is required'),
            self::EMAIL_PARAM . 'email' => __('The description of the task is required'),
            self::EMAIL_PARAM . 'string' => __('The description of the task must be a string'),
            self::PASSWORD_PARAM . 'required' => __('The start date of the task is required'),
            self::PASSWORD_PARAM . 'string' => __('The start date of the task must be a valid date'),
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
