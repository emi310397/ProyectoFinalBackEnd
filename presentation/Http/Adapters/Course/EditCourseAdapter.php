<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Course;

use Application\Commands\Course\EditCourseCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class EditCourseAdapter extends CommandAdapter
{
    private CourseRepositoryInterface $courseRepository;

    private const ID_PARAM = 'id';
    private const TITLE_PARAM = 'title';
    private const DESCRIPTION_PARAM = 'description';

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
            self::ID_PARAM => 'bail|required|integer|gt:0',
            self::TITLE_PARAM => 'bail|required|string',
            self::DESCRIPTION_PARAM => 'bail|required|string',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::ID_PARAM . 'required' => __('The id of the course is required'),
            self::ID_PARAM . 'integer' => __('The id of the course must be a number'),
            self::ID_PARAM . 'gt' => __('The id of the course must be a string'),
            self::TITLE_PARAM . 'required' => __('The title of the course is required'),
            self::TITLE_PARAM . 'string' => __('The title of the course must be a string'),
            self::DESCRIPTION_PARAM . 'required' => __('The description of the course is required'),
            self::DESCRIPTION_PARAM . 'string' => __('The description of the course must be a string'),
        ];
    }

    public function adapt(Request $request): EditCourseCommand
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::ID_PARAM);
        $rules[self::ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $course = $this->courseRepository->getByIdOrFail($id);

        return new EditCourseCommand(
            $course,
            $request->get(self::TITLE_PARAM),
            $request->get(self::DESCRIPTION_PARAM)
        );
    }
}
