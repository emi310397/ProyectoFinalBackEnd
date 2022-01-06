<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\Course;
use Domain\Entities\Student;
use Domain\Entities\StudentGroup;

/**
 * Interface StudentGroupRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method StudentGroup[]       findAll()
 * @method null|StudentGroup    find($id, $lockMode = null, $lockVersion = null)
 * @method StudentGroup[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method StudentGroup    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method StudentGroup         save(StudentGroup $studentGroup)
 *
 * @package Domain\Interfaces\Repositories
 */
interface StudentGroupRepositoryInterface extends BaseRepositoryInterface
{
    public function getByIdOrFail(int $id): StudentGroup;

    public function getAllByCourse(Course $course): ?array;

    public function getAllByStudent(Student $student): ?array;
}
