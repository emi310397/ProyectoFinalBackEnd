<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\User;

/**
 * Interface UserRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method User[]       findAll()
 * @method null|User    find($id, $lockMode = null, $lockVersion = null)
 * @method User[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method User    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method User         save(User $user)
 *
 * @package Domain\Interfaces\Repositories
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getByIdOrFail(int $id): User;
}
