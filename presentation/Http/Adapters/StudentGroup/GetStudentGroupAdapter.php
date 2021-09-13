<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\StudentGroup;

use Application\Queries\StudentGroup\GetStudentGroupQuery;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class GetStudentGroupAdapter extends CommandAdapter
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
            self::ID_PARAM => 'required|integer|gt:0'
        ];
    }

    public function getMessages(): array
    {
        return [
            self::ID_PARAM . '.required' => __('The id of the class is required'),
            self::ID_PARAM . '.integer' => __('The id of the class must be a number'),
            self::ID_PARAM . '.gt' => __('The id of the class must be a greater than 0')
        ];
    }

    public function adapt(Request $request): GetStudentGroupQuery
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::ID_PARAM);
        $rules[self::ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $studentGroup = $this->studentGroupRepository->getByIdOrFail($id);

        return new GetStudentGroupQuery($studentGroup);
    }
}
