<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Token;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\TokenRepositoryInterface;

/**
 * Class TokenRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method Token[]  findAll()
 * @method null|Token  find($id, $lockMode = null, $lockVersion = null)
 * @method Token[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Token    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Token         save(Token $token)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */
class TokenRepository extends BaseRepository implements TokenRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Token::class));
    }

    public function getByHash(string $hash): ?Token
    {
        return $this->findOneBy(['hash' => $hash]);
    }

    public function getByUser(User $user): ?Token
    {
        return $this->findOneBy(['user' => $user]);
    }

    public function getAllByUser(User $user): ?array
    {
        return $this->findBy(['user' => $user, 'expired' => false]);
    }

    public function getUserLastToken(User $user): ?Token
    {
        return $this->findOneBy(['user' => $user], ['createdAt' => 'DESC']);
    }
}
