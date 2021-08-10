<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\Teacher;

/**
 * Interface TeacherRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method Teacher[]       findAll()
 * @method null|Teacher    find($id, $lockMode = null, $lockVersion = null)
 * @method Teacher[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Teacher    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Teacher         save(Teacher $teacher)
 *
 * @package Domain\Interfaces\Repositories
 */
interface TeacherRepositoryInterface extends BaseRepositoryInterface
{
    public function getByIdOrFail(int $id): Teacher;
}
