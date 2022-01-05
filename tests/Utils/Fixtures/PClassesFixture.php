<?php

declare(strict_types=1);

namespace Tests\Utils\Fixtures;

use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Domain\Entities\PClass;

class PClassesFixture extends Fixture
{
    public const COURSE_1_PCLASS_1 = 'couse_1_pclass_1';
    public const COURSE_1_PCLASS_2 = 'couse_1_pclass_2';
    public const COURSE_1_PCLASS_3 = 'couse_1_pclass_3';
    public const COURSE_2_PCLASS_1 = 'couse_2_pclass_1';
    public const COURSE_2_PCLASS_2 = 'couse_2_pclass_2';
    public const COURSE_2_PCLASS_3 = 'couse_2_pclass_3';
    public const COURSE_3_PCLASS_1 = 'couse_3_pclass_1';
    public const COURSE_3_PCLASS_2 = 'couse_3_pclass_2';
    public const COURSE_3_PCLASS_3 = 'couse_3_pclass_3';

    public function load(ObjectManager $manager): void
    {
        array_map([$manager, 'persist'], $this->getInstances());

        $manager->flush();
    }

    public function getInstances(): array
    {
        $course1pclass1 = new PClass(
            $this->getReference(CoursesFixture::COURSE_1),
            'class 1',
            'class description',
            new DateTime(date('Y-m-d H:i:s', strtotime('-50 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('-30 hours')))
        );
        $this->addReference(self::COURSE_1_PCLASS_1, $course1pclass1);

        $course1pclass2 = new PClass(
            $this->getReference(CoursesFixture::COURSE_1),
            'class 2',
            'class description',
            new DateTime(date('Y-m-d H:i:s', strtotime('-10 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('+10 hours')))
        );
        $this->addReference(self::COURSE_1_PCLASS_2, $course1pclass2);

        $course1pclass3 = new PClass(
            $this->getReference(CoursesFixture::COURSE_1),
            'class 3',
            'class description',
            new DateTime(date('Y-m-d H:i:s', strtotime('+30 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('+50 hours')))
        );
        $this->addReference(self::COURSE_1_PCLASS_3, $course1pclass3);

        $course2pclass1 = new PClass(
            $this->getReference(CoursesFixture::COURSE_2),
            'class 1',
            'class description',
            new DateTime(date('Y-m-d H:i:s', strtotime('+10 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('+30 hours')))
        );
        $this->addReference(self::COURSE_2_PCLASS_1, $course2pclass1);

        $course2pclass2 = new PClass(
            $this->getReference(CoursesFixture::COURSE_2),
            'class 2',
            'class description',
            new DateTime(date('Y-m-d H:i:s', strtotime('+50 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('+70 hours')))
        );
        $this->addReference(self::COURSE_2_PCLASS_2, $course2pclass2);

        $course2pclass3 = new PClass(
            $this->getReference(CoursesFixture::COURSE_2),
            'class 3',
            'class description',
            new DateTime(date('Y-m-d H:i:s', strtotime('+90 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('+110 hours')))
        );
        $this->addReference(self::COURSE_2_PCLASS_3, $course2pclass3);

        $course3pclass1 = new PClass(
            $this->getReference(CoursesFixture::COURSE_3),
            'class 1',
            'class description',
            new DateTime(date('Y-m-d H:i:s', strtotime('-50 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('-30 hours')))
        );
        $this->addReference(self::COURSE_3_PCLASS_1, $course3pclass1);

        $course3pclass2 = new PClass(
            $this->getReference(CoursesFixture::COURSE_3),
            'class 2',
            'class description',
            new DateTime(date('Y-m-d H:i:s', strtotime('-10 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('+10 hours')))
        );
        $this->addReference(self::COURSE_3_PCLASS_2, $course3pclass2);

        $course3pclass3 = new PClass(
            $this->getReference(CoursesFixture::COURSE_3),
            'class 3',
            'class description',
            new DateTime(date('Y-m-d H:i:s', strtotime('+30 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('+50 hours')))
        );
        $this->addReference(self::COURSE_3_PCLASS_3, $course3pclass3);

        return [
            $course1pclass1,
            $course1pclass2,
            $course1pclass3,
            $course2pclass1,
            $course2pclass2,
            $course2pclass3,
            $course3pclass1,
            $course3pclass2,
            $course3pclass3,
        ];
    }
}
