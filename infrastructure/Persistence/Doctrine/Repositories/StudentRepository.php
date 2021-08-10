<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Student;
use Domain\Interfaces\Repositories\StudentRepositoryInterface;

/**
 * Class StudentRepository
 *
 * Inherited method signature rewriting:
 *
 * @method Student[]  findAll()
 * @method Student  find($id, $lockMode = null, $lockVersion = null)
 * @method Student[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method null|Student    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Student         save(Student $student)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Student::class));
    }

    public function getByIdOrFail(int $id): Student
    {
        $student = $this->findOneBy(['id' => $id, 'deletedAt' => null]);

        if (!$student) {
            throw new EntityNotFoundException(__('Student not found'));
        }

        return $student;
    }
}
