<?php

declare(strict_types=1);

namespace Tests\Utils\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Domain\Entities\Course;

class CoursesFixture extends Fixture
{
    public const COURSE_1 = 'course_1';
    public const COURSE_2 = 'course_2';
    public const COURSE_3 = 'course_3';

    public function load(ObjectManager $manager): void
    {
        array_map([$manager, 'persist'], $this->getInstances());

        $manager->flush();
    }

    public function getInstances(): array
    {
        $course1 = new Course(
            'Course 1',
            'course description 1',
            $this->getReference(UserFixture::TEACHER_USER_1)
        );
        $this->addReference(self::COURSE_1, $course1);

        $course2 = new Course(
            'Course 2',
            'course description 2',
            $this->getReference(UserFixture::TEACHER_USER_2)
        );
        $this->addReference(self::COURSE_2, $course2);

        $course3 = new Course(
            'Course 3',
            'course description 3',
            $this->getReference(UserFixture::TEACHER_USER_3)
        );
        $this->addReference(self::COURSE_3, $course3);

        return [
            $course1,
            $course2,
            $course3,
        ];
    }
}
