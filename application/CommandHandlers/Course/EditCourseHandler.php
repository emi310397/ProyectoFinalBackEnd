<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Course;

use Application\Commands\Course\EditCourseCommand;
use DateTime;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;

class EditCourseHandler
{
    private CourseRepositoryInterface $courseRepository;

    public function __construct(
        CourseRepositoryInterface $courseRepository
    ) {
        $this->courseRepository = $courseRepository;
    }

    public function handle(EditCourseCommand $command): void
    {
        $course = $command->getCourse();

        $command->getTitle() ? $course->setTitle($command->getTitle()) : null;
        $command->getDescription() ? $course->setDescription($command->getDescription()) : null;
        $course->setUpdatedAt(new DateTime());

        $this->courseRepository->update();
    }
}
