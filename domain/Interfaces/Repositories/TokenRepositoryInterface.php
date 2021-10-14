<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\Token;
use Domain\Entities\User;

/**
 * Interface TokenRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method Token[]  findAll()
 * @method null|Token    find($id, $lockMode = null, $lockVersion = null)
 * @method Token[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Token    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Token         save(Token $token)
 *
 * @package Domain\Interfaces\Repositories
 */
interface TokenRepositoryInterface extends BaseRepositoryInterface
{
    public function getByHash(string $hash): ?Token;

    public function getUserLastToken(User $user): ?Token;

    public function getByUser(User $user): ?Token;

    public function getAllByUser(User $user): ?array;
}
