<?php

declare(strict_types=1);

namespace Tests\Utils\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Domain\Entities\Session;

class SessionFixture extends Fixture
{
    public const TEACHER_1_SESSION_1 = 'session_1';
    public const STUDENT_1_SESSION_2 = 'session_2';
    public const STUDENT_2_EXPIRED_SESSION_3 = 'session_3';

    public function load(ObjectManager $manager): void
    {
        array_map([$manager, 'persist'], $this->getInstances());

        $manager->flush();
    }

    public function getInstances(): array
    {
        $session1 = new Session($this->getReference(UserFixture::TEACHER_USER_1), self::TEACHER_1_SESSION_1);
        $this->addReference(self::TEACHER_1_SESSION_1, $session1);

        $session2 = new Session($this->getReference(UserFixture::STUDENT_USER_2), self::STUDENT_1_SESSION_2);
        $this->addReference(self::STUDENT_1_SESSION_2, $session2);

        $session3 = new Session($this->getReference(UserFixture::STUDENT_USER_3), self::STUDENT_2_EXPIRED_SESSION_3);
        $session3->expire();
        $this->addReference(self::STUDENT_2_EXPIRED_SESSION_3, $session3);

        return [
            $session1,
            $session2,
            $session3,
        ];
    }
}
