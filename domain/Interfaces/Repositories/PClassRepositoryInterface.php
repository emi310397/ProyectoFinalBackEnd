<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\PClass;
use Domain\Entities\User;

/**
 * Interface PClassRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method PClass[]       findAll()
 * @method null|PClass    find($id, $lockMode = null, $lockVersion = null)
 * @method PClass[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method PClass    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method PClass         save(PClass $PClass)
 *
 * @package Domain\Interfaces\Repositories
 */
interface PClassRepositoryInterface extends BaseRepositoryInterface
{
    public function getByIdOrFail(int $id): PClass;

    public function getAllByUser(User $user): array;
}
