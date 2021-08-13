<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\PClass;

use Application\Commands\PClass\DeletePClassCommand;
use Domain\Adapters\CommandAdapter;
use Domain\Interfaces\Repositories\PClassRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class DeletePClassAdapter extends CommandAdapter
{
    private PClassRepositoryInterface $PClassRepository;

    private const ID_PARAM = 'id';

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
        ];
    }

    public function getMessages(): array
    {
        return [
            self::ID_PARAM . 'required' => __('The id of the class is required'),
            self::ID_PARAM . 'integer' => __('The id of the class must be a number'),
            self::ID_PARAM . 'gt' => __('The id of the class must be a greater than 0'),
        ];
    }

    public function adapt(Request $request): DeletePClassCommand
    {
        $rules = $request->all();
        $id = (int)$request->route()->parameter(self::ID_PARAM);
        $rules[self::ID_PARAM] = $id;
        $this->assertRulesAreValid($rules);

        $PClass = $this->PClassRepository->getByIdOrFail($id);

        return new DeletePClassCommand($PClass);
    }
}
