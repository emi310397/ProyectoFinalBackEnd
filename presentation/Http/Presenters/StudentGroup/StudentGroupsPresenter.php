<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\StudentGroup;

use Application\Results\StudentGroup\StudentGroupsResult;
use Domain\Entities\StudentGroup;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class StudentGroupsPresenter implements PresenterInterface
{
    private StudentGroupsResult $result;

    public function fromResult(StudentGroupsResult $result): StudentGroupsPresenter
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
        $studentGroups = $this->result->getStudentGroups();

        $studentGroupsIds = $this->getStudentGroupsIds($studentGroups);

        return [
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
