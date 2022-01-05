<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\User;

use Application\Results\User\UserResult;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class UserPresenter implements PresenterInterface
{
    private UserResult $result;

    public function fromResult(UserResult $result): UserPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function toJson(): string
    {
        return json_encode($this->getData());
    }

    public function getData(): array
    {
        $user = $this->result->getUser();

        return [
            'id' => $user->getId(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'status' => $user->getStatus(),
        ];
    }
}
