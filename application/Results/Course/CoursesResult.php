<?php

declare(strict_types=1);

namespace Application\Results\Course;

class CoursesResult
{
    private array $courses;

    public function __construct(array $courses)
    {
        $this->courses = $courses;
    }

    public function getCourses(): array
    {
        return $this->courses;
    }
}
