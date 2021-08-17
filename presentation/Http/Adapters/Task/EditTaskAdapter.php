<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Task;

use Application\Commands\Task\EditTaskCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class EditTaskAdapter extends CommandAdapter
{
    private TaskRepositoryInterface $taskRepository;

    private const TASK_ID_PARAM = 'id';
    private const TITLE_PARAM = 'title';
    private const DESCRIPTION_PARAM = 'description';
    private const FROM_DATE_PARAM = 'fromDate';
    private const TO_DATE_PARAM = 'toDate';

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
            self::TITLE_PARAM => 'bail|nullable|string',
            self::DESCRIPTION_PARAM => 'bail|nullable|string',
            self::FROM_DATE_PARAM => 'bail|nullable|date',
            self::TO_DATE_PARAM => 'bail|nullable|date|after:' . self::FROM_DATE_PARAM,
        ];
    }

    public function getMessages(): array
    {
        return [
            self::TASK_ID_PARAM . 'required' => __('The id of the task is required'),
            self::TASK_ID_PARAM . 'integer' => __('The id of the task must be a number'),
            self::TASK_ID_PARAM . 'gt' => __('The id of the task must be a greater than 0'),
            self::TITLE_PARAM . 'string' => __('The title of the task must be a string'),
            self::DESCRIPTION_PARAM . 'string' => __('The description of the task must be a string'),
            self::FROM_DATE_PARAM . 'date' => __('The start date of the task must be a valid date'),
            self::TO_DATE_PARAM . 'date' => __('The end date of the task must be a valid date'),
            self::TO_DATE_PARAM . 'after' => __('The end date of the task must be higher than the start date'),
        ];
    }

    public function adapt(Request $request): EditTaskCommand
    {
        $this->assertRulesAreValid($request->all());

        $task = $this->taskRepository->getByIdOrFail($request->get(self::TASK_ID_PARAM));

        return new EditTaskCommand(
            $task,
            $request->get(self::TITLE_PARAM),
            $request->get(self::DESCRIPTION_PARAM),
            $request->get(self::FROM_DATE_PARAM),
            $request->get(self::TO_DATE_PARAM)
        );
    }
}
