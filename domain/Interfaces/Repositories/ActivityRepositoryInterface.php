<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\Activity;

/**
 * Interface ActivityRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method Activity[]       findAll()
 * @method null|Activity    find($id, $lockMode = null, $lockVersion = null)
 * @method Activity[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Activity    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Activity         save(Activity $activity)
 *
 * @package Domain\Interfaces\Repositories
 */
interface ActivityRepositoryInterface extends BaseRepositoryInterface
{
    public function getByIdOrFail(int $id): Activity;
}
