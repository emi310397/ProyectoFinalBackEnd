<?php

declare(strict_types=1);

namespace Application\Validators\StudentGroup;

use Domain\Entities\Course;
use Domain\Entities\StudentGroup;
use DomainException;

class StudentGroupToCourseMembershipValidator
{
    public function validate(array $studentGroups, Course $course): void
    {
        /* @var StudentGroup $studentGroup */
        foreach ($studentGroups as $studentGroup) {
            $this->validateSingleStudentGroup($studentGroup, $course);
        }
    }

    public function validateSingleStudentGroup(StudentGroup $studentGroup, Course $course): void
    {
        $studentGroupCourse = $studentGroup->getCourse();
        if (!$course === $studentGroupCourse) {
            throw new DomainException(__('There is a student group that do not belong to this course'));
        }
    }
}
