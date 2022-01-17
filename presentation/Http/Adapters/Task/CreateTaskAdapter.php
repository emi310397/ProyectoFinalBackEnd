<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Task;

use Application\Commands\Task\CreateTaskCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class CreateTaskAdapter extends CommandAdapter
{
    private CourseRepositoryInterface $courseRepository;

    private const COURSE_ID_PARAM = 'id';
    private const TITLE_PARAM = 'title';
    private const DESCRIPTION_PARAM = 'description';
    private const FROM_DATE_PARAM = 'fromDate';
    private const TO_DATE_PARAM = 'toDate';

    public function __construct(
        ValidatorServiceInterface $validator,
        CourseRepositoryInterface $courseRepository
    ) {
        parent::__construct($validator);
        $this->courseRepository = $courseRepository;
    }

    public function getRules(): array
    {
        return [
            self::COURSE_ID_PARAM => 'bail|required|integer|gt:0',
            self::TITLE_PARAM => 'bail|required|string',
            self::DESCRIPTION_PARAM => 'bail|required|string',
            self::FROM_DATE_PARAM => 'bail|required|date',
            self::TO_DATE_PARAM => 'bail|required|date|after:' . self::FROM_DATE_PARAM,
        ];
    }

    public function getMessages(): array
    {
        return [
            self::COURSE_ID_PARAM . 'required' => __('The id of the course is required'),
            self::COURSE_ID_PARAM . 'integer' => __('The id of the course must be a number'),
            self::COURSE_ID_PARAM . 'gt' => __('The id of the course must be a greater than 0'),
            self::TITLE_PARAM . 'required' => __('The title of the task is required'),
            self::TITLE_PARAM . 'string' => __('The title of the task must be a string'),
            self::DESCRIPTION_PARAM . 'required' => __('The description of the task is required'),
            self::DESCRIPTION_PARAM . 'string' => __('The description of the task must be a string'),
            self::FROM_DATE_PARAM . 'required' => __('The start date of the task is required'),
            self::FROM_DATE_PARAM . 'date' => __('The start date of the task must be a valid date'),
            self::TO_DATE_PARAM . 'required' => __('The end date of the task is required'),
            self::TO_DATE_PARAM . 'date' => __('The end date of the task must be a valid date'),
            self::TO_DATE_PARAM . 'after' => __('The end date of the task must be higher than the start date'),
        ];
    }

    public function adapt(Request $request): CreateTaskCommand
    {
        $rules = $request->all();
        $courseId = (int)$request->route()->parameter(self::COURSE_ID_PARAM);
        $rules[self::COURSE_ID_PARAM] = $courseId;
        $this->assertRulesAreValid($rules);

        $course = $this->courseRepository->getByIdOrFail($courseId);

        return new CreateTaskCommand(
            $course,
            $request->get(self::TITLE_PARAM),
            $request->get(self::DESCRIPTION_PARAM),
            $request->get(self::FROM_DATE_PARAM),
            $request->get(self::TO_DATE_PARAM)
        );
    }
}
