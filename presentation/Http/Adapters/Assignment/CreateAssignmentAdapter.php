<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Assignment;

use Application\Commands\Assignment\CreateAssignmentCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class CreateAssignmentAdapter extends CommandAdapter
{
    private TaskRepositoryInterface $taskRepository;

    private const TASK_ID_PARAM = 'id';
    private const TITLE_PARAM = 'title';

    public function __construct(
        ValidatorServiceInterface $validator,
        TaskRepositoryInterface $taskRepository
    ) {
        parent::__construct($validator);
        $this->taskRepository = $taskRepository;
    }

    public function getRules(): array
    {
        return [
            self::TASK_ID_PARAM => 'bail|required|integer|gt:0',
            self::TITLE_PARAM => 'bail|required|string',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::TASK_ID_PARAM . 'required' => __('The id of the class is required'),
            self::TASK_ID_PARAM . 'integer' => __('The id of the class must be a number'),
            self::TASK_ID_PARAM . 'gt' => __('The id of the class must be a greater than 0'),
            self::TITLE_PARAM . 'required' => __('The title of the task is required'),
            self::TITLE_PARAM . 'string' => __('The title of the task must be a string'),
        ];
    }

    public function adapt(Request $request): CreateAssignmentCommand
    {
        $this->assertRulesAreValid($request->all());

        $task = $this->taskRepository->getByIdOrFail($request->get(self::TASK_ID_PARAM));

        return new CreateAssignmentCommand(
            $task,
            $request->get(self::TITLE_PARAM)
        );
    }
}
