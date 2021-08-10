<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\PClass;

use Application\Commands\PClass\CreatePClassCommand;
use Domain\Adapters\CommandAdapter;
use Illuminate\Http\Request;

class CreatePClassAdapter extends CommandAdapter
{
    private const SUBJECT_PARAM = 'subject';
    private const DESCRIPTION_PARAM = 'description';

    public function getRules(): array
    {
        return [
            self::SUBJECT_PARAM => 'bail|required|string',
            self::DESCRIPTION_PARAM => 'bail|required|string',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::SUBJECT_PARAM . 'required' => __('The subject of the class is required'),
            self::SUBJECT_PARAM . 'string' => __('The subject of the class must be a string'),
            self::DESCRIPTION_PARAM . 'required' => __('The description of the class is required'),
            self::DESCRIPTION_PARAM . 'string' => __('The description of the class is not valid'),
        ];
    }

    public function adapt(Request $request): CreatePClassCommand
    {
        $this->assertRulesAreValid($request->all());

        return new CreatePClassCommand(
            $request->get(self::SUBJECT_PARAM),
            $request->get(self::DESCRIPTION_PARAM)
        );
    }
}
