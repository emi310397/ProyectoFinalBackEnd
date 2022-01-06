<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Course;

use Application\Commands\Course\CreateCourseCommand;
use Domain\Entities\Course;
use Domain\Interfaces\CurrentUserInterface;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;

class CreateCourseHandler
{
    private CourseRepositoryInterface $courseRepository;
    private CurrentUserInterface $currentUser;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        CurrentUserInterface $currentUser
    ) {
        $this->courseRepository = $courseRepository;
        $this->currentUser = $currentUser;
    }

    public function handle(CreateCourseCommand $command): void
    {
        $teacher = $this->currentUser->getUser();

        $course = new Course(
            $command->getTitle(),
            $command->getDescription(),
            $teacher
        );

        $this->courseRepository->save($course);
    }
}
