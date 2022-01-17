<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Course;

use Application\Commands\Course\CreateCourseCommand;
use Domain\Entities\Course;
use Domain\Interfaces\CurrentUserInterface;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;
use Domain\Interfaces\Repositories\UserRepositoryInterface;

class CreateCourseHandler
{
    private CourseRepositoryInterface $courseRepository;
    private UserRepositoryInterface $userRepository;
    private CurrentUserInterface $currentUser;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        UserRepositoryInterface $userRepository,
        CurrentUserInterface $currentUser
    ) {
        $this->courseRepository = $courseRepository;
        $this->userRepository = $userRepository;
        $this->currentUser = $currentUser;
    }

    public function handle(CreateCourseCommand $command): void
    {
        $teacher = $this->currentUser->getTeacher();

        $course = new Course(
            $command->getTitle(),
            $command->getDescription(),
            $command->getFromDate(),
            $command->getToDate(),
            $teacher,
            $command->getDays()
        );

        $teacher->addCourses($course);

        $this->courseRepository->save($course);
        $this->userRepository->update();
    }
}
