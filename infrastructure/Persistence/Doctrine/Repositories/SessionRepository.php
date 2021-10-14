<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Session;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\SessionRepositoryInterface;

/**
 * Class SessionRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method Session[]  findAll()
 * @method null|Session  find($id, $lockMode = null, $lockVersion = null)
 * @method Session[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Session    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Session         save(Session $token)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */
class SessionRepository extends BaseRepository implements SessionRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Session::class));
    }

    public function getByHash(string $hash): ?Session
    {
        return $this->findOneBy(['hash' => $hash]);
    }

    public function getByUser(User $user): ?Session
    {
        return $this->findOneBy(['user' => $user]);
    }

    public function getAllByUser(User $user): ?array
    {
        return $this->findBy(['user' => $user, 'expired' => false]);
    }

    public function getUserLastSession(User $user): ?Session
    {
        return $this->findOneBy(['user' => $user], ['createdAt' => 'DESC']);
    }
}
