<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Course;

use Application\Commands\Course\DeleteCourseCommand;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;

class DeleteCourseHandler
{
    private CourseRepositoryInterface $courseRepository;

    public function __construct(
        CourseRepositoryInterface $courseRepository
    ) {
        $this->courseRepository = $courseRepository;
    }

    public function handle(DeleteCourseCommand $command): void
    {
        $this->courseRepository->delete($command->getCourse());
    }
}
