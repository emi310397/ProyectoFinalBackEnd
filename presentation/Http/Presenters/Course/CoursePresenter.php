<?php

declare(strict_types=1);

namespace Presentation\Http\Presenters\Course;

use Application\Results\Course\CourseResult;
use Infrastructure\Presenter\Contracts\PresenterInterface;

class CoursePresenter implements PresenterInterface
{
    private CourseResult $result;

    public function fromResult(CourseResult $result): CoursePresenter
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
        $course = $this->result->getCourse();

        return [
            'id' => $course->getId(),
            'title' => $course->getTitle(),
            'description' => $course->getDescription()
        ];
    }
}
