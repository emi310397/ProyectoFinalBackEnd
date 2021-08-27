<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Assignment;

use Application\Commands\Assignment\DeleteAssignmentCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\AssignmentRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class DeleteAssignmentAdapter extends CommandAdapter
{
    private AssignmentRepositoryInterface $assignmentRepository;

    private const ID_PARAM = 'id';

    public function __construct(
        ValidatorServiceInterface $validator,
        AssignmentRepositoryInterface $assignmentRepository
    ) {
        parent::__construct($validator);
        $this->assignmentRepository = $assignmentRepository;
    }

    public function getRules(): array
    {
        return [
            self::ID_PARAM => 'bail|required|integer|gt:0',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::ID_PARAM . 'required' => __('The id of the assignment is required'),
            self::ID_PARAM . 'integer' => __('The id of the assignment must be a number'),
            self::ID_PARAM . 'gt' => __('The id of the assignment must be a greater than 0'),
        ];
    }

    public function adapt(Request $request): DeleteAssignmentCommand
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::ID_PARAM);
        $rules[self::ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $assignment = $this->assignmentRepository->getByIdOrFail($id);

        return new DeleteAssignmentCommand($assignment);
    }
}
