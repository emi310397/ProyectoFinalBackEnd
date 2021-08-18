<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\Task;
use Domain\Entities\User;

/**
 * Interface TaskRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method Task[]       findAll()
 * @method null|Task    find($id, $lockMode = null, $lockVersion = null)
 * @method Task[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Task    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Task         save(Task $task)
 *
 * @package Domain\Interfaces\Repositories
 */
interface TaskRepositoryInterface extends BaseRepositoryInterface
{
    public function getByIdOrFail(int $id): Task;

    public function getAllByUser(User $user): array;
}
