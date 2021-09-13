<?php

declare(strict_types=1);

namespace Application\QueryHandlers\Course;

use Application\Queries\Course\GetCourseQuery;
use Application\Results\Course\CourseResult;

class GetCourseHandler
{
    public function handle(GetCourseQuery $command): CourseResult
    {
        return new CourseResult($command->getCourse());
    }
}
