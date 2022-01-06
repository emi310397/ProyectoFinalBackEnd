<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\Course;

use Application\Results\Course\CoursesResult;
use Domain\Entities\Course;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class CoursesPresenter implements PresenterInterface
{
    private CoursesResult $result;

    public function fromResult(CoursesResult $result): CoursesPresenter
    {
        $this->result = $result;
        return $this;
    }

    public function toJson(): string
    {
        return json_encode($this->getData());
    }

    public function getData(): array
    {
        $courses = $this->result->getCourses();

        return [
            'courses' => $this->getCoursesIds($courses)
        ];
    }

    private function getCoursesIds(array $courses): array
    {
        $coursesIds = [];

        /* @var Course $course */
        foreach ($courses as $course) {
            $coursesIds[] = $course->getId();
        }

        return $coursesIds;
    }
}
