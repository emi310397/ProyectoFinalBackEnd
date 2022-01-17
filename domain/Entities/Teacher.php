<?php

declare(strict_types=1);

namespace Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Teacher extends User
{
    private Collection $courses;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ) {
        parent::__construct($firstName, $lastName, $email, $password);
        $this->courses = new ArrayCollection();
    }

    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourses(Course $course): void
    {
        $this->courses->add($course);
    }
}
