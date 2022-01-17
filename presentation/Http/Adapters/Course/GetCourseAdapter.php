<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Course;

use Application\Queries\Course\GetCourseQuery;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class GetCourseAdapter extends CommandAdapter
{
    private CourseRepositoryInterface $courseRepository;

    private const ID_PARAM = 'id';

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
            self::ID_PARAM => 'required|integer|gt:0'
        ];
    }

    public function getMessages(): array
    {
        return [
            self::ID_PARAM . '.required' => __('The id of the course is required'),
            self::ID_PARAM . '.integer' => __('The id of the course must be a number'),
            self::ID_PARAM . '.gt' => __('The id of the course must be a greater than 0')
        ];
    }

    public function adapt(Request $request): GetCourseQuery
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::ID_PARAM);
        $rules[self::ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $course = $this->courseRepository->getByIdOrFail($id);

        return new GetCourseQuery($course);
    }
}
