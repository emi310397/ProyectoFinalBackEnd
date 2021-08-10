<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Teacher;
use Domain\Interfaces\Repositories\TeacherRepositoryInterface;

/**
 * Class TeacherRepository
 *
 * Inherited method signature rewriting:
 *
 * @method Teacher[]  findAll()
 * @method Teacher  find($id, $lockMode = null, $lockVersion = null)
 * @method Teacher[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method null|Teacher    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Teacher         save(Teacher $teacher)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */

class TeacherRepository extends BaseRepository implements TeacherRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Teacher::class));
    }

    public function getByIdOrFail(int $id): Teacher
    {
        $teacher = $this->findOneBy(['id' => $id, 'deletedAt' => null]);

        if (!$teacher) {
            throw new EntityNotFoundException(__('Teacher not found'));
        }

        return $teacher;
    }
}
