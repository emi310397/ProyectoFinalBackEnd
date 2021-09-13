<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\StudentGroup;

use Application\Commands\StudentGroup\EditStudentGroupCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;
use Domain\Interfaces\Repositories\StudentRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class EditStudentGroupAdapter extends CommandAdapter
{
    private StudentGroupRepositoryInterface $studentGroupRepository;
    private StudentRepositoryInterface $studentRepository;

    private const ID_PARAM = 'id';
    private const NAME_PARAM = 'name';
    private const DESCRIPTION_PARAM = 'description';
    private const STUDENTS_IDS_PARAM = 'studentsIds';

    public function __construct(
        ValidatorServiceInterface $validator,
        StudentGroupRepositoryInterface $studentGroupRepository,
        StudentRepositoryInterface $studentRepository
    ) {
        parent::__construct($validator);
        $this->studentGroupRepository = $studentGroupRepository;
        $this->studentRepository = $studentRepository;
    }

    public function getRules(): array
    {
        return [
            self::ID_PARAM => 'bail|required|integer|gt:0',
            self::NAME_PARAM => 'bail|required|string',
            self::DESCRIPTION_PARAM => 'bail|required|string',
            self::STUDENTS_IDS_PARAM => 'bail|required|array',
            self::STUDENTS_IDS_PARAM . '.*' => 'bail|required|integer|gt:0|distinct',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::ID_PARAM . 'required' => __('The description of the student group is required'),
            self::ID_PARAM . 'integer' => __('The description of the student group must be a string'),
            self::ID_PARAM . 'gt' => __('The description of the student group must be a string'),
            self::NAME_PARAM . 'required' => __('The subject of the class is required'),
            self::NAME_PARAM . 'string' => __('The subject of the class must be a string'),
            self::DESCRIPTION_PARAM . 'required' => __('The description of the class is required'),
            self::DESCRIPTION_PARAM . 'string' => __('The description of the class must be a string'),
            self::STUDENTS_IDS_PARAM . 'required' => __('The description of the class is required'),
            self::STUDENTS_IDS_PARAM . 'integer' => __('The description of the class must be a string'),
            self::STUDENTS_IDS_PARAM . '.*.required' => __('The description of the class is required'),
            self::STUDENTS_IDS_PARAM . '.*.integer' => __('The description of the class must be a string'),
            self::STUDENTS_IDS_PARAM . '.*.required' => __('The description of the class is required'),
            self::STUDENTS_IDS_PARAM . '.*.integer' => __('The description of the class must be a string'),
        ];
    }

    public function adapt(Request $request): EditStudentGroupCommand
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::ID_PARAM);
        $rules[self::ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $studentGroup = $this->studentGroupRepository->getByIdOrFail($id);

        $studentsIds = $request->get(self::STUDENTS_IDS_PARAM);
        $students = array_map([$this->studentRepository, 'findOrFail'], $studentsIds);

        return new EditStudentGroupCommand(
            $studentGroup,
            $request->get(self::NAME_PARAM),
            $request->get(self::DESCRIPTION_PARAM),
            $students
        );
    }
}
