<?php

declare(strict_types=1);

namespace Tests\Utils\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Domain\Entities\StudentGroup;

class StudentGroupFixture extends Fixture
{
    public const STUDENT_GROUP_1 = 'student_group_1';
    public const STUDENT_GROUP_2 = 'student_group_2';
    public const STUDENT_GROUP_3 = 'student_group_3';

    public function load(ObjectManager $manager): void
    {
        array_map([$manager, 'persist'], $this->getInstances());

        $manager->flush();
    }

    public function getInstances(): array
    {
        $studentGroup1 = new StudentGroup(
            'Grupo 1',
            'Descripción Grupo 1',
            $this->getReference(CourseFixture::COURSE_1),
            [
                $this->getReference(UserFixture::STUDENT_USER_1),
                $this->getReference(UserFixture::STUDENT_USER_2),
                $this->getReference(UserFixture::NON_ACTIVATED_STUDENT_USER),
            ]
        );
        $this->addReference(self::STUDENT_GROUP_1, $studentGroup1);

        $studentGroup2 = new StudentGroup(
            'Grupo 2',
            'Descripción Grupo 2',
            $this->getReference(CourseFixture::COURSE_1)
        );
        $studentGroup2->addStudent($this->getReference(UserFixture::STUDENT_USER_3));
        $studentGroup2->addStudent($this->getReference(UserFixture::STUDENT_USER_4));
        $this->addReference(self::STUDENT_GROUP_2, $studentGroup2);

        $studentGroup3 = new StudentGroup(
            'Grupo 3',
            'Descripción Grupo 3',
            $this->getReference(CourseFixture::COURSE_2),
            [
                $this->getReference(UserFixture::STUDENT_USER_8),
                $this->getReference(UserFixture::STUDENT_USER_9),
                $this->getReference(UserFixture::NON_ACTIVATED_STUDENT_USER),
            ]
        );
        $this->addReference(self::STUDENT_GROUP_3, $studentGroup3);

        return [
            $studentGroup1,
            $studentGroup2,
            $studentGroup3,
        ];
    }
}
