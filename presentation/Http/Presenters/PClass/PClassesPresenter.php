<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\PClass;

use Application\Results\PClass\PClassesResult;
use Application\Results\PClass\PClassResult;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class PClassesPresenter implements PresenterInterface
{
    private PClassesResult $result;

    public function fromResult(PClassesResult $result): PClassesPresenter
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
        $data = [];
        $PClassesResults = $this->result->getPClassesResults();

        $PClassPresenter = new PClassPresenter();

        /* @var PClassResult $PClassResult */
        foreach ($PClassesResults as $PClassResult) {
            $PClassPresenter->fromResult($PClassResult);

            $data[] = $PClassPresenter->getData();
        }

        return $data;
    }
}
