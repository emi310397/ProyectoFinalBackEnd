<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\Session;
use Domain\Entities\User;

/**
 * Interface SessionRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method Session[]  findAll()
 * @method null|Session    find($id, $lockMode = null, $lockVersion = null)
 * @method Session[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Session    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Session         save(Session $session)
 *
 * @package Domain\Interfaces\Repositories
 */
interface SessionRepositoryInterface extends BaseRepositoryInterface
{
    public function getByHash(string $hash): ?Session;

    public function getUserLastSession(User $user): ?Session;

    public function getByUser(User $user): ?Session;

    public function getAllByUser(User $user): ?array;
}
