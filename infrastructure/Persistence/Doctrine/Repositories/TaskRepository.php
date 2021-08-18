<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Task;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\TaskRepositoryInterface;

/**
 * Class TaskRepository
 *
 * Inherited method signature rewriting:
 *
 * @method Task[]  findAll()
 * @method Task  find($id, $lockMode = null, $lockVersion = null)
 * @method Task[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method null|Task    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Task         save(Task $task)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */
class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Task::class));
    }

    public function getByIdOrFail(int $id): Task
    {
        $task = $this->findOneBy(['id' => $id, 'deletedAt' => null]);

        if (!$task) {
            throw new EntityNotFoundException(__('Task not found'));
        }

        return $task;
    }

    public function getAllByUser(User $user): array
    {
        $qb = $this->createQueryBuilder('tasks');
        $qb->where('tasks.deletedAt IS NULL')
            ->andWhere('IDENTITY(tasks.user) = :user')
            ->setParameter('user', $user->getId());
        return $qb->getQuery()->execute();
    }
}
