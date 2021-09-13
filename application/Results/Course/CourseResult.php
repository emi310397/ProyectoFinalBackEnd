<?php

declare(strict_types=1);

namespace Application\Results\Course;

use Domain\Entities\Course;

class CourseResult
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
