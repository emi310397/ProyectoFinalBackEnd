<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Assignment;
use Domain\Entities\Student;
use Domain\Entities\Task;
use Domain\Interfaces\Repositories\AssignmentRepositoryInterface;

/**
 * Class AssignmentRepository
 *
 * Inherited method signature rewriting:
 *
 * @method Assignment[]  findAll()
 * @method Assignment  find($id, $lockMode = null, $lockVersion = null)
 * @method Assignment[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method null|Assignment    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Assignment         save(Assignment $assignment)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */
class AssignmentRepository extends BaseRepository implements AssignmentRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Assignment::class));
    }

    public function getByIdOrFail(int $id): Assignment
    {
        $assignment = $this->findOneBy(['id' => $id, 'deletedAt' => null]);

        if (!$assignment) {
            throw new EntityNotFoundException(__('Assignment not found'));
        }

        return $assignment;
    }

    public function getAllByStudent(Student $student): array
    {
        $qb = $this->createQueryBuilder('assignments');
        $qb->where('assignments.deletedAt IS NULL')
            ->andWhere('IDENTITY(assignments.student) = :student')
            ->setParameter('student', $student->getId());
        return $qb->getQuery()->execute();
    }

    public function getAllByTask(Task $task): array
    {
        $qb = $this->createQueryBuilder('assignments');
        $qb->where('assignments.deletedAt IS NULL')
            ->andWhere('IDENTITY(assignments.task) = :task')
            ->setParameter('task', $task->getId());
        return $qb->getQuery()->execute();
    }
}
