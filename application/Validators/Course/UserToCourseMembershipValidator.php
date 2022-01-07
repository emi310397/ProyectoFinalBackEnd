<?php

declare(strict_types=1);

namespace Application\Validators\Course;

use Application\Exceptions\DomainException;
use Application\Exceptions\DomainRuntimeException;
use Domain\Entities\Course;
use Domain\Entities\Student;
use Domain\Entities\StudentGroup;
use Domain\Entities\Teacher;
use Domain\Entities\User;
use Domain\Interfaces\CurrentUserInterface;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;

class UserToCourseMembershipValidator
{
    private CurrentUserInterface $currentUser;
    private StudentGroupRepositoryInterface $studentGroupRepository;

    public function __construct(
        CurrentUserInterface $currentUser,
        StudentGroupRepositoryInterface $studentGroupRepository
    ) {
        $this->currentUser = $currentUser;
        $this->studentGroupRepository = $studentGroupRepository;
    }

    public function validateCurrentUser(Course $course): void
    {
        $currentUser = $this->currentUser->getUser();

        if ($currentUser) {
            $this->validate($currentUser, $course);
        } else {
            throw new DomainException(__('No current user found'));
        }
    }

    public function validate(User $user, Course $course): void
    {
        if ($user instanceof Teacher) {
            $this->validateIfTeacherBelongsToCourse($user, $course);
        } else {
            if ($user instanceof Student) {
                $this->validateIfStudentBelongsToCourse($user, $course);
            } else {
                throw new DomainRuntimeException(__('Invalid user type'));
            }
        }
    }

    private function validateIfTeacherBelongsToCourse(User $user, Course $course)
    {
        if (!($course->getTeacher() === $user)) {
            throw new DomainException(__('The teacher does not belong to this course'));
        }
    }

    private function validateIfStudentBelongsToCourse(User $user, Course $course)
    {
        $userInGroup = false;
        $studentGroups = $this->studentGroupRepository->getAllByCourse($course);

        /* @var StudentGroup $studentGroup */
        foreach ($studentGroups as $studentGroup) {
            if (in_array($user, $studentGroup->getStudents()->toArray())) {
                $userInGroup = true;
            }
        }

        if (!$userInGroup) {
            throw new DomainException(__('The student does not belong to this course'));
        }
    }
}
