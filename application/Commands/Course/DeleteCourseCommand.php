<?php

declare(strict_types=1);

namespace Application\Commands\Course;

use Domain\CommandBus\CommandInterface;
use Domain\Entities\Course;

class DeleteCourseCommand implements CommandInterface
{
    private Course $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }
}
