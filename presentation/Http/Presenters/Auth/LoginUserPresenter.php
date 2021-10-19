<?php

namespace Presentation\Http\Presenters\Auth;

use Application\Results\Auth\LoginUserResult;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class LoginUserPresenter implements PresenterInterface
{
    private LoginUserResult $result;

    public function fromResult(LoginUserResult $result): LoginUserPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array
    {
        return [
            'hash' => $this->result->getSession()->getHash(),
            'userStatus' => $this->result->getUserStatus()
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->getData(), JSON_THROW_ON_ERROR);
    }
}
