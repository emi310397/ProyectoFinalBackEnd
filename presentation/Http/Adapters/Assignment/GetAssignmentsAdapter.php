<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Assignment;

use Application\Queries\Assignment\GetAssignmentsQuery;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class GetAssignmentsAdapter extends CommandAdapter
{
    private UserRepositoryInterface $userRepository;

    private const USER_ID_PARAM = 'userId';

    public function __construct(
        ValidatorServiceInterface $validator,
        UserRepositoryInterface $userRepository
    ) {
        parent::__construct($validator);
        $this->userRepository = $userRepository;
    }

    public function getRules(): array
    {
        return [
            self::USER_ID_PARAM => 'required|integer|gt:0'
        ];
    }

    public function getMessages(): array
    {
        return [
            self::USER_ID_PARAM . '.required' => __('The id of the user is required'),
            self::USER_ID_PARAM . '.integer' => __('The id of the user must be a number'),
            self::USER_ID_PARAM . '.gt' => __('The id of the user must be a greater than 0')
        ];
    }

    public function adapt(Request $request): GetAssignmentsQuery
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::USER_ID_PARAM);
        $rules[self::USER_ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $user = $this->userRepository->getByIdOrFail($id);

        return new GetAssignmentsQuery($user);
    }
}
