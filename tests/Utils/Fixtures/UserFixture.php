<?php

declare(strict_types=1);

namespace Tests\Utils\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Domain\Entities\Student;
use Domain\Entities\Teacher;
use Illuminate\Support\Facades\Hash;

class UserFixture extends Fixture
{
    public const TEACHER_USER_1 = 'teacher_user_1';
    public const TEACHER_USER_2 = 'teacher_user_2';
    public const TEACHER_USER_3 = 'teacher_user_3';
    public const STUDENT_USER_1 = 'student_user_1';
    public const STUDENT_USER_2 = 'student_user_2';
    public const STUDENT_USER_3 = 'student_user_3';
    public const STUDENT_USER_4 = 'student_user_4';
    public const STUDENT_USER_5 = 'student_user_5';
    public const STUDENT_USER_6 = 'student_user_6';
    public const STUDENT_USER_7 = 'student_user_7';
    public const STUDENT_USER_8 = 'student_user_8';
    public const STUDENT_USER_9 = 'student_user_9';
    public const NON_ACTIVATED_TEACHER_USER = 'non_activated_teacher_user_4';
    public const NON_ACTIVATED_STUDENT_USER = 'non_activated_student_user_10';

    public function load(ObjectManager $manager): void
    {
        array_map([$manager, 'persist'], $this->getInstances());

        $manager->flush();
    }

    public function getInstances(): array
    {
        $teacherUser1 = new Teacher('Teacher1FirstName', 'Teacher1LastName', 'teacher1@example.com', Hash::make('123456789'));
        $teacherUser1->activate();
        $this->addReference(self::TEACHER_USER_1, $teacherUser1);

        $teacherUser2 = new Teacher('Teacher2FirstName', 'Teacher2LastName', 'teacher2@example.com', Hash::make('123456789'));
        $teacherUser2->activate();
        $this->addReference(self::TEACHER_USER_2, $teacherUser2);

        $teacherUser3 = new Teacher('Teacher3FirstName', 'Teacher3LastName', 'teacher3@example.com', Hash::make('123456789'));
        $teacherUser3->activate();
        $this->addReference(self::TEACHER_USER_3, $teacherUser3);

        $studentUser1 = new Student('Student1FirstName', 'Student1LastName', 'student1@example.com', Hash::make('123456789'));
        $studentUser1->activate();
        $this->addReference(self::STUDENT_USER_1, $studentUser1);

        $studentUser2 = new Student('Student2FirstName', 'Student2LastName', 'student2@example.com', Hash::make('123456789'));
        $studentUser2->activate();
        $this->addReference(self::STUDENT_USER_2, $studentUser2);

        $studentUser3 = new Student('Student3FirstName', 'Student3LastName', 'student3@example.com', Hash::make('123456789'));
        $studentUser3->activate();
        $this->addReference(self::STUDENT_USER_3, $studentUser3);

        $studentUser4 = new Student('Student4FirstName', 'Student4LastName', 'student4@example.com', Hash::make('123456789'));
        $studentUser4->activate();
        $this->addReference(self::STUDENT_USER_4, $studentUser4);

        $studentUser5 = new Student('Student5FirstName', 'Student5LastName', 'student5@example.com', Hash::make('123456789'));
        $studentUser5->activate();
        $this->addReference(self::STUDENT_USER_5, $studentUser5);

        $studentUser6 = new Student('Student6FirstName', 'Student6LastName', 'student6@example.com', Hash::make('123456789'));
        $studentUser6->activate();
        $this->addReference(self::STUDENT_USER_6, $studentUser6);

        $studentUser7 = new Student('Student7FirstName', 'Student7LastName', 'student7@example.com', Hash::make('123456789'));
        $studentUser7->activate();
        $this->addReference(self::STUDENT_USER_7, $studentUser7);

        $studentUser8 = new Student('Student8FirstName', 'Student8LastName', 'student8@example.com', Hash::make('123456789'));
        $studentUser8->activate();
        $this->addReference(self::STUDENT_USER_8, $studentUser8);

        $studentUser9 = new Student('Student9FirstName', 'Student9LastName', 'student9@example.com', Hash::make('123456789'));
        $studentUser9->activate();
        $this->addReference(self::STUDENT_USER_9, $studentUser9);

        $nonActivatedTeacherUser10 = new Teacher('Teacher4FirstName', 'Teacher4LastName', 'teacher4@example.com', Hash::make('123456789'));
        $this->addReference(self::NON_ACTIVATED_TEACHER_USER, $nonActivatedTeacherUser10);

        $nonActivatedStudentUser10 = new Student('Student10FirstName', 'Student10LastName', 'student10@example.com', Hash::make('123456789'));
        $this->addReference(self::NON_ACTIVATED_STUDENT_USER, $nonActivatedStudentUser10);

        return [
            $teacherUser1,
            $teacherUser2,
            $teacherUser3,
            $studentUser1,
            $studentUser2,
            $studentUser3,
            $studentUser4,
            $studentUser5,
            $studentUser6,
            $studentUser7,
            $studentUser8,
            $studentUser9,
            $nonActivatedTeacherUser10,
            $nonActivatedStudentUser10,
        ];
    }
}
