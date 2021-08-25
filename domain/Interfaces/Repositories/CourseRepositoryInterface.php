<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\Course;

/**
 * Interface CourseRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method Course[]       findAll()
 * @method null|Course    find($id, $lockMode = null, $lockVersion = null)
 * @method Course[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Course    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Course         save(Course $course)
 *
 * @package Domain\Interfaces\Repositories
 */
interface CourseRepositoryInterface extends BaseRepositoryInterface
{
    public function getByIdOrFail(int $id): Course;
}
