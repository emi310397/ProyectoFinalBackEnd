<?php

declare(strict_types=1);

namespace Presentation\Http\Adapters\Auth;

use Application\Commands\Auth\ConfirmUserCommand;
use Application\Validators\Auth\TokenValidator;
use Doctrine\ORM\EntityNotFoundException;
use Domain\Adapters\CommandAdapter;
use Domain\Enums\TokenTypes;
use Domain\Interfaces\Repositories\TokenRepositoryInterface;
use Illuminate\Http\Request;
use Presentation\Interfaces\ValidatorServiceInterface;

class ConfirmUserAdapter extends CommandAdapter
{
    private const HASH_PARAM = "hash";

    private TokenRepositoryInterface $tokenRepository;
    private TokenValidator $tokenValidator;

    public function __construct(
        ValidatorServiceInterface $validator,
        TokenRepositoryInterface $tokenRepository,
        TokenValidator $tokenValidator
    ) {
        parent::__construct($validator);
        $this->tokenRepository = $tokenRepository;
        $this->tokenValidator = $tokenValidator;
    }

    public function getRules(): array
    {
        return [
            self::HASH_PARAM => 'required',
        ];
    }

    public function getMessages(): array
    {
        return [
            self::HASH_PARAM . '.required' => __('The account confirmation hash is required'),
        ];
    }

    public function adapt(Request $request): ConfirmUserCommand
    {
        $hash = (string)$request->route()->parameter(self::HASH_PARAM);

        $rules = $request->all();
        $rules[self::HASH_PARAM] = $hash;
        $this->assertRulesAreValid($rules);

        $token = $this->tokenRepository->getByHash($hash);

        if (!$token) {
            throw new EntityNotFoundException(__('The token does not exists'));
        }

        $this->tokenValidator->fromCommand($token)->validateWithType(TokenTypes::ACCOUNT_REGISTER);

        return new ConfirmUserCommand($token);
    }
}
