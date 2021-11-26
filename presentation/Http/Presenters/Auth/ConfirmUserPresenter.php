<?php

namespace Presentation\Http\Presenters\Auth;

use Application\Results\Auth\ConfirmUserResult;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class ConfirmUserPresenter implements PresenterInterface
{
    private ConfirmUserResult $result;

    public function fromResult(ConfirmUserResult $result): ConfirmUserPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function getData(): array
    {
        return [
            'session' => $this->result->getSession()->getHash()
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->getData());
    }
}
