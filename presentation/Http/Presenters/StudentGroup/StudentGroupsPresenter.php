<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\StudentGroup;

use Application\Results\StudentGroup\StudentGroupResult;
use Domain\Entities\Student;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class StudentGroupsPresenter implements PresenterInterface
{
    private StudentGroupResult $result;

    public function fromResult(StudentGroupResult $result): StudentGroupsPresenter
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
        $studentGroup = $this->result->getStudentGroup();

        $studentsIds = $this->getStudentsIds($studentGroup->getStudents()->toArray());

        return [
            'id' => $studentGroup->getId(),
            'name' => $studentGroup->getName(),
            'description' => $studentGroup->getDescription(),
            'course' => $studentGroup->getCourse()->getId(),
            'students' => $studentsIds
        ];
    }

    private function getStudentsIds(array $students): array
    {
        $studentsIds = [];

        /* @var Student $student */
        foreach ($students as $student) {
            $studentsIds[] = $student->getId();
        }

        return $studentsIds;
    }
}
