<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\Assignment;

use Application\Results\Assignment\AssignmentResult;
use Domain\Entities\StudentGroup;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class AssignmentPresenter implements PresenterInterface
{
    private AssignmentResult $result;

    public function fromResult(AssignmentResult $result): AssignmentPresenter
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
        $assignment = $this->result->getAssignment();

        $studentGroupsIds = $this->getStudentGroupsIds($assignment->getStudents()->toArray());

        return [
            'id' => $assignment->getId(),
            'task' => $assignment->getTask()->getId(),
            'studentGroups' => $studentGroupsIds
        ];
    }

    private function getStudentGroupsIds(array $studentGroups): array
    {
        $studentGroupsIds = [];

        /* @var StudentGroup $studentGroup */
        foreach ($studentGroups as $studentGroup) {
            $studentGroupsIds[] = $studentGroup->getId();
        }

        return $studentGroupsIds;
    }
}
