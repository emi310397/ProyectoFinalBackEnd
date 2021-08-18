<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Task;

use Application\Queries\Task\GetTaskQuery;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class GetTaskAdapter extends CommandAdapter
{
    private TaskRepositoryInterface $taskRepository;

    private const ID_PARAM = 'id';

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
            self::ID_PARAM => 'required|integer|gt:0'
        ];
    }

    public function getMessages(): array
    {
        return [
            self::ID_PARAM . '.required' => __('The id of the task is required'),
            self::ID_PARAM . '.integer' => __('The id of the task must be a number'),
            self::ID_PARAM . '.gt' => __('The id of the task must be a greater than 0')
        ];
    }

    public function adapt(Request $request): GetTaskQuery
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::ID_PARAM);
        $rules[self::ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $task = $this->taskRepository->getByIdOrFail($id);

        return new GetTaskQuery($task);
    }
}
