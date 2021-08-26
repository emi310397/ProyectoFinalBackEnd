<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\Assignment;

use Application\Results\Assignment\AssignmentResult;
use Application\Results\Assignment\AssignmentsResult;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class AssignmentsPresenter implements PresenterInterface
{
    private AssignmentsResult $result;

    public function fromResult(AssignmentsResult $result): AssignmentsPresenter
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
        $assignmentsResults = $this->result->getAssignmentsResults();

        $assignmentPresenter = new AssignmentPresenter();

        /* @var AssignmentResult $assignmentResult */
        foreach ($assignmentsResults as $assignmentResult) {
            $assignmentPresenter->fromResult($assignmentResult);

            $data[] = $assignmentPresenter->getData();
        }

        return $data;
    }
}
