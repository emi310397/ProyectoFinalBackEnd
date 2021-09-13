<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Course;

use Application\Commands\Course\CreateCourseCommand;
use Domain\Adapters\CommandAdapter;
use Illuminate\Http\Request;

class CreateCourseAdapter extends CommandAdapter
{
    private const TITLE_PARAM = 'title';
    private const DESCRIPTION_PARAM = 'description';

    public function getRules(): array
    {
        return [
            self::TITLE_PARAM => 'bail|required|string',
            self::DESCRIPTION_PARAM => 'bail|required|string',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::TITLE_PARAM . 'required' => __('The title of the course is required'),
            self::TITLE_PARAM . 'string' => __('The title of the course must be a string'),
            self::DESCRIPTION_PARAM . 'required' => __('The description of the course is required'),
            self::DESCRIPTION_PARAM . 'string' => __('The description of the course must be a string'),
        ];
    }

    public function adapt(Request $request): CreateCourseCommand
    {
        $this->assertRulesAreValid($request->all());

        return new CreateCourseCommand(
            $request->get(self::TITLE_PARAM),
            $request->get(self::DESCRIPTION_PARAM)
        );
    }
}
