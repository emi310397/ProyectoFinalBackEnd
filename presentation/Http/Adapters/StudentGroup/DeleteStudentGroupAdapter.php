<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\StudentGroup;

use Application\Commands\StudentGroup\DeleteStudentGroupCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class DeleteStudentGroupAdapter extends CommandAdapter
{
    private StudentGroupRepositoryInterface $studentGroupRepository;

    private const ID_PARAM = 'id';

    public function __construct(
        ValidatorServiceInterface $validator,
        StudentGroupRepositoryInterface $studentGroupRepository
    ) {
        parent::__construct($validator);
        $this->studentGroupRepository = $studentGroupRepository;
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
            self::ID_PARAM . 'required' => __('The description of the student group is required'),
            self::ID_PARAM . 'integer' => __('The description of the student group must be a string'),
            self::ID_PARAM . 'gt' => __('The description of the student group must be a string'),
        ];
    }

    public function adapt(Request $request): DeleteStudentGroupCommand
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::ID_PARAM);
        $rules[self::ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $studentGroup = $this->studentGroupRepository->getByIdOrFail($id);

        return new DeleteStudentGroupCommand($studentGroup);
    }
}
