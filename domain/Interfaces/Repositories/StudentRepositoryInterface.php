<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\Student;

/**
 * Interface StudentRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method Student[]       findAll()
 * @method null|Student    find($id, $lockMode = null, $lockVersion = null)
 * @method Student[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Student    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Student         save(Student $student)
 *
 * @package Domain\Interfaces\Repositories
 */
interface StudentRepositoryInterface extends BaseRepositoryInterface
{
    public function getByIdOrFail(int $id): Student;
}
