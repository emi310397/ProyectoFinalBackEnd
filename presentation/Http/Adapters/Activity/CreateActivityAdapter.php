<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Activity;

use Application\Commands\Activity\CreateActivityCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class CreateActivityAdapter extends CommandAdapter
{
    private TaskRepositoryInterface $taskRepository;

    private const TITLE_PARAM = 'title';
    private const TYPE_PARAM = 'type';
    private const DESCRIPTION_PARAM = 'description';
    private const BODY_PARAM = 'body';
    private const TASK_ID_PARAM = 'taskId';

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
            self::TITLE_PARAM => 'bail|required|string',
            self::TYPE_PARAM => 'bail|required|integer',
            self::DESCRIPTION_PARAM => 'bail|required|string',
            self::BODY_PARAM => 'bail|required|json',
            self::TASK_ID_PARAM => 'bail|required|integer|gt:0',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::TITLE_PARAM . 'required' => __('The title of the activity is required'),
            self::TITLE_PARAM . 'string' => __('The title of the activity must be a string'),
            self::TYPE_PARAM . 'required' => __('The type of the activity is required'),
            self::TYPE_PARAM . 'integer' => __('The type of the activity must be a string'),
            self::DESCRIPTION_PARAM . 'required' => __('The description of the activity is required'),
            self::DESCRIPTION_PARAM . 'string' => __('The description of the activity must be a string'),
            self::BODY_PARAM . 'required' => __('The body of the activity is required'),
            self::BODY_PARAM . 'json' => __('The body of the activity must be a string json'),
            self::TASK_ID_PARAM . 'required' => __('The description of the activity is required'),
            self::TASK_ID_PARAM . 'string' => __('The description of the activity must be a number'),
            self::TASK_ID_PARAM . 'gt' => __('The description of the activity must be greater than 0'),
        ];
    }

    public function adapt(Request $request): CreateActivityCommand
    {
        $this->assertRulesAreValid($request->all());

        $task = $this->taskRepository->getByIdOrFail($request->get(self::TASK_ID_PARAM));

        return new CreateActivityCommand(
            $request->get(self::TITLE_PARAM),
            $request->get(self::TYPE_PARAM),
            $request->get(self::DESCRIPTION_PARAM),
            $request->get(self::BODY_PARAM),
            $task
        );
    }
}
