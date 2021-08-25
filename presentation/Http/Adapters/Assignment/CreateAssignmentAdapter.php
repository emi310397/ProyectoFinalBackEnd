<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Assignment;

use Application\Commands\Assignment\CreateAssignmentCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class CreateAssignmentAdapter extends CommandAdapter
{
    private TaskRepositoryInterface $taskRepository;
    private StudentGroupRepositoryInterface $studentGroupRepository;

    private const TASK_ID_PARAM = 'task';
    private const STUDENT_GROUPS_PARAM = 'studentGroups';

    public function __construct(
        ValidatorServiceInterface $validator,
        TaskRepositoryInterface $taskRepository,
        StudentGroupRepositoryInterface $studentGroupRepository
    ) {
        parent::__construct($validator);
        $this->taskRepository = $taskRepository;
        $this->studentGroupRepository = $studentGroupRepository;
    }

    public function getRules(): array
    {
        return [
            self::TASK_ID_PARAM => 'bail|required|integer|gt:0',
            self::STUDENT_GROUPS_PARAM => 'bail|required|array',
            self::STUDENT_GROUPS_PARAM . '.*' => 'bail|required|integer|gt:0|distinct',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::TASK_ID_PARAM . 'required' => __('The id of the class is required'),
            self::TASK_ID_PARAM . 'integer' => __('The id of the class must be a number'),
            self::TASK_ID_PARAM . 'gt' => __('The id of the class must be a greater than 0'),
            self::STUDENT_GROUPS_PARAM . 'required' => __('The student groups of the assigment are required'),
            self::STUDENT_GROUPS_PARAM . 'array' => __('The student groups of the assigment must be an array'),
            self::STUDENT_GROUPS_PARAM . '.*.required'  => __('At least one student group id is required'),
            self::STUDENT_GROUPS_PARAM . '.*.integer'  => __('The student group id must be a number'),
            self::STUDENT_GROUPS_PARAM . '.*.gt'  => __('The student group id must be a greater than 0'),
            self::STUDENT_GROUPS_PARAM . '.*.distinct'  => __('The student group ids can not be repeated'),
        ];
    }

    public function adapt(Request $request): CreateAssignmentCommand
    {
        $this->assertRulesAreValid($request->all());

        $studentGroupsIds = $request->get(self::STUDENT_GROUPS_PARAM);
        $studentGroups = array_map([$this->studentGroupRepository, 'findOrFail'], $studentGroupsIds);

        $task = $this->taskRepository->getByIdOrFail($request->get(self::TASK_ID_PARAM));

        return new CreateAssignmentCommand(
            $task,
            $studentGroups
        );
    }
}
