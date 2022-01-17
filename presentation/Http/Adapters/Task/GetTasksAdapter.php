<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Task;

use Application\Queries\PClass\GetPClassesQuery;
use Application\Queries\Task\GetTasksQuery;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;
use Domain\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class GetTasksAdapter extends CommandAdapter
{
    private CourseRepositoryInterface $courseRepository;

    private const COURSE_ID_PARAM = 'id';

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
            self::COURSE_ID_PARAM => 'required|integer|gt:0'
        ];
    }

    public function getMessages(): array
    {
        return [
            self::COURSE_ID_PARAM . '.required' => __('The id of the user is required'),
            self::COURSE_ID_PARAM . '.integer' => __('The id of the user must be a number'),
            self::COURSE_ID_PARAM . '.gt' => __('The id of the user must be a greater than 0')
        ];
    }

    public function adapt(Request $request): GetTasksQuery
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::COURSE_ID_PARAM);
        $rules[self::COURSE_ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $course = $this->courseRepository->getByIdOrFail($id);

        return new GetTasksQuery($course);
    }
}
