<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\PClass;

use Application\Results\PClass\PClassResult;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class PClassPresenter implements PresenterInterface
{
    private PClassResult $result;

    public function fromResult(PClassResult $result): PClassPresenter
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
