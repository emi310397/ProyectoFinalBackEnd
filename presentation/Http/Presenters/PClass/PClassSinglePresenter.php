<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\PClass;

use Application\Results\PClass\PClassSingleResult;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class PClassSinglePresenter implements PresenterInterface
{
    private PClassSingleResult $result;

    public function fromResult(PClassSingleResult $result): PClassSinglePresenter
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
        $PClass = $this->result->getPClass();

        return [
            'id' => $PClass->getId(),
            'subject' => $PClass->getSubject(),
            'description' => $PClass->getDescription()
        ];
    }
}
