<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\PClass;

use Application\Commands\PClass\EditPClassCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\PClassRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class EditPClassAdapter extends CommandAdapter
{
    private PClassRepositoryInterface $PClassRepository;

    private const ID_PARAM = 'id';
    private const SUBJECT_PARAM = 'subject';
    private const DESCRIPTION_PARAM = 'description';

    public function __construct(
        ValidatorServiceInterface $validator,
        PClassRepositoryInterface $PClassRepository
    ) {
        parent::__construct($validator);
        $this->PClassRepository = $PClassRepository;
    }

    public function getRules(): array
    {
        return [
            self::ID_PARAM => 'bail|required|integer|gt:0',
            self::SUBJECT_PARAM => 'bail|nullable|string',
            self::DESCRIPTION_PARAM => 'bail|nullable|string',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::ID_PARAM . 'required' => __('The id of the class is required'),
            self::ID_PARAM . 'integer' => __('The id of the class must be a number'),
            self::ID_PARAM . 'gt' => __('The id of the class must be a greater than 0'),
            self::SUBJECT_PARAM . 'string' => __('The subject of the class must be a string'),
            self::DESCRIPTION_PARAM . 'string' => __('The description of the class must be a string'),
        ];
    }

    public function adapt(Request $request): EditPClassCommand
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::ID_PARAM);
        $rules[self::ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $PClass = $this->PClassRepository->getByIdOrFail($id);

        return new EditPClassCommand(
            $PClass,
            $request->get(self::SUBJECT_PARAM),
            $request->get(self::DESCRIPTION_PARAM)
        );
    }
}
