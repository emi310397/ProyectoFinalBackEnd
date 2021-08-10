<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\UserRepositoryInterface;

/**
 * Class UserRepository
 *
 * Inherited method signature rewriting:
 *
 * @method User[]  findAll()
 * @method User  find($id, $lockMode = null, $lockVersion = null)
 * @method User[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method null|User    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method User         save(User $user)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(User::class));
    }

    public function getByIdOrFail(int $id): User
    {
        $user = $this->findOneBy(['id' => $id, 'deletedAt' => null]);

        if (!$user) {
            throw new EntityNotFoundException(__('User not found'));
        }

        return $user;
    }
}
