<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\StudentGroup;

use Application\Commands\StudentGroup\CreateStudentGroupCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;
use Domain\Interfaces\Repositories\StudentRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class CreateStudentGroupAdapter extends CommandAdapter
{
    private CourseRepositoryInterface $courseRepository;
    private StudentRepositoryInterface $studentRepository;

    private const NAME_PARAM = 'name';
    private const DESCRIPTION_PARAM = 'description';
    private const COURSE_ID_PARAM = 'courseId';
    private const STUDENTS_IDS_PARAM = 'studentsIds';

    public function __construct(
        ValidatorServiceInterface $validator,
        CourseRepositoryInterface $courseRepository,
        StudentRepositoryInterface $studentRepository
    ) {
        parent::__construct($validator);
        $this->courseRepository = $courseRepository;
        $this->studentRepository = $studentRepository;
    }

    public function getRules(): array
    {
        return [
            self::NAME_PARAM => 'bail|required|string',
            self::DESCRIPTION_PARAM => 'bail|required|string',
            self::COURSE_ID_PARAM => 'bail|required|integer|gt:0',
            self::STUDENTS_IDS_PARAM => 'bail|required|array',
            self::STUDENTS_IDS_PARAM . '.*' => 'bail|required|integer|gt:0|distinct',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::NAME_PARAM . 'required' => __('The subject of the class is required'),
            self::NAME_PARAM . 'string' => __('The subject of the class must be a string'),
            self::DESCRIPTION_PARAM . 'required' => __('The description of the class is required'),
            self::DESCRIPTION_PARAM . 'string' => __('The description of the class must be a string'),
            self::COURSE_ID_PARAM . 'required' => __('The description of the class is required'),
            self::COURSE_ID_PARAM . 'integer' => __('The description of the class must be a string'),
            self::COURSE_ID_PARAM . 'gt' => __('The description of the class must be a string'),
            self::STUDENTS_IDS_PARAM . 'required' => __('The description of the class is required'),
            self::STUDENTS_IDS_PARAM . 'integer' => __('The description of the class must be a string'),
            self::STUDENTS_IDS_PARAM . '.*.required' => __('The description of the class is required'),
            self::STUDENTS_IDS_PARAM . '.*.integer' => __('The description of the class must be a string'),
            self::STUDENTS_IDS_PARAM . '.*.required' => __('The description of the class is required'),
            self::STUDENTS_IDS_PARAM . '.*.integer' => __('The description of the class must be a string'),
        ];
    }

    public function adapt(Request $request): CreateStudentGroupCommand
    {
        $this->assertRulesAreValid($request->all());

        $studentsIds = $request->get(self::STUDENTS_IDS_PARAM);
        $students = array_map([$this->studentRepository, 'findOrFail'], $studentsIds);

        $course = $this->courseRepository->getByIdOrFail($request->get(self::COURSE_ID_PARAM));

        return new CreateStudentGroupCommand(
            $request->get(self::NAME_PARAM),
            $request->get(self::DESCRIPTION_PARAM),
            $course,
            $students
        );
    }
}
