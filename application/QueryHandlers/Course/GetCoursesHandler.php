<?php

declare(strict_types=1);

namespace Application\QueryHandlers\Course;

use Application\Queries\Course\GetCoursesQuery;
use Application\Results\Course\CoursesResult;
use Domain\Entities\Student;
use Domain\Entities\StudentGroup;
use Domain\Entities\Teacher;
use Domain\Interfaces\CurrentUserInterface;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;

class GetCoursesHandler
{
    private CurrentUserInterface $currentUser;
    private CourseRepositoryInterface $courseRepository;
    private StudentGroupRepositoryInterface $studentGroupRepository;

    public function __construct(CurrentUserInterface $currentUser,
        CourseRepositoryInterface $courseRepository,
        StudentGroupRepositoryInterface $studentGroupRepository
    ) {
        $this->currentUser = $currentUser;
        $this->courseRepository = $courseRepository;
        $this->studentGroupRepository = $studentGroupRepository;
    }

    public function handle(GetCoursesQuery $query): CoursesResult
    {
        $courses = [];

        $currentUser = $this->currentUser->getUser();

        if ($currentUser instanceof Teacher) {
            $courses = $this->courseRepository->getAllByTeacher($currentUser);
        } elseif ($currentUser instanceof Student) {
            $studentGroups = $this->studentGroupRepository->getAllByStudent($currentUser);

            /* @var StudentGroup $studentGroup */
            foreach ($studentGroups as $studentGroup) {
                $courses[] = $studentGroup->getCourse();
            }
        }

        return new CoursesResult(array_unique($courses, SORT_REGULAR));
    }
}
