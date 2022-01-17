<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Course;

use Application\Commands\Course\CreateCourseCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Enums\DaysOfTheWeek;
use Illuminate\Http\Request;

class CreateCourseAdapter extends CommandAdapter
{
    private const TITLE_PARAM = 'title';
    private const DESCRIPTION_PARAM = 'description';
    private const DAYS_PARAM = 'days';
    private const FROM_DATE_PARAM = 'fromDate';
    private const TO_DATE_PARAM = 'toDate';

    public function getRules(): array
    {
        return [
            self::TITLE_PARAM => 'bail|required|string',
            self::DESCRIPTION_PARAM => 'bail|required|string',
            self::DAYS_PARAM => 'bail|array|nullable',
            self::DAYS_PARAM . '.*' => 'distinct|integer|in:' . implode(',', DaysOfTheWeek::ALL_DAYS),
            self::FROM_DATE_PARAM => 'bail|required|date',
            self::TO_DATE_PARAM => 'bail|required|date|after:' . self::FROM_DATE_PARAM,
        ];
    }

    public function getMessages(): array
    {
        return [
            self::TITLE_PARAM . 'required' => __('The title of the course is required'),
            self::TITLE_PARAM . 'string' => __('The title of the course must be a string'),
            self::DESCRIPTION_PARAM . 'required' => __('The description of the course is required'),
            self::DESCRIPTION_PARAM . 'string' => __('The description of the course must be a string'),
            self::DAYS_PARAM . 'array' => __('The days of the course must be an array'),
            self::DAYS_PARAM . '.*.distinct' => __('The days of the course can not be repeated'),
            self::DAYS_PARAM . '.*.integer' => __('The day of the course must be a number'),
            self::DAYS_PARAM . '.*.in' => __('The day of the course must be between 1 and 7'),
            self::FROM_DATE_PARAM . 'required' => __('The start date of the task is required'),
            self::FROM_DATE_PARAM . 'date' => __('The start date of the task must be a valid date'),
            self::TO_DATE_PARAM . 'required' => __('The end date of the task is required'),
            self::TO_DATE_PARAM . 'date' => __('The end date of the task must be a valid date'),
            self::TO_DATE_PARAM . 'after' => __('The end date of the task must be higher than the start date'),
        ];
    }

    public function adapt(Request $request): CreateCourseCommand
    {
        $this->assertRulesAreValid($request->all());

        return new CreateCourseCommand(
            $request->get(self::TITLE_PARAM),
            $request->get(self::DESCRIPTION_PARAM),
            $request->get(self::FROM_DATE_PARAM),
            $request->get(self::TO_DATE_PARAM),
            $request->get(self::DAYS_PARAM)
        );
    }
}
