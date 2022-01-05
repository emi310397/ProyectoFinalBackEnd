<?php

declare(strict_types=1);

namespace Tests\Utils\Fixtures;

use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Domain\Entities\Task;

class TasksFixture extends Fixture
{
    public const TASK_1 = 'task_1';
    public const TASK_2 = 'task_2';
    public const TASK_3 = 'task_3';

    public function load(ObjectManager $manager): void
    {
        array_map([$manager, 'persist'], $this->getInstances());

        $manager->flush();
    }

    public function getInstances(): array
    {
        $task1 = new Task(
            'task 1',
            'task description',
            new DateTime(date('Y-m-d H:i:s', strtotime('-50 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('-30 hours'))),
            [$this->getReference(PClassFixture::COURSE_1_PCLASS_1)]
        );
        $this->addReference(self::TASK_1, $task1);

        $task2 = new Task(
            'task 2',
            'task description',
            new DateTime(date('Y-m-d H:i:s', strtotime('-10 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('+10 hours'))),
            [$this->getReference(PClassFixture::COURSE_1_PCLASS_2)]
        );
        $this->addReference(self::TASK_2, $task2);

        $task3 = new Task(
            'task 3',
            'task description',
            new DateTime(date('Y-m-d H:i:s', strtotime('-50 hours'))),
            new DateTime(date('Y-m-d H:i:s', strtotime('-30 hours'))),
            [$this->getReference(PClassFixture::COURSE_2_PCLASS_1)]
        );
        $this->addReference(self::TASK_3, $task3);

        return [
            $task1,
            $task2,
            $task3,
        ];
    }
}
