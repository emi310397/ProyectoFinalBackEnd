<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\StudentGroup;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;

/**
 * Class StudentGroupRepository
 *
 * Inherited method signature rewriting:
 *
 * @method StudentGroup[]  findAll()
 * @method StudentGroup  find($id, $lockMode = null, $lockVersion = null)
 * @method StudentGroup[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method null|StudentGroup    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method StudentGroup         save(StudentGroup $studentGroup)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */
class StudentGroupRepository extends BaseRepository implements StudentGroupRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(StudentGroup::class));
    }

    public function getByIdOrFail(int $id): StudentGroup
    {
        $studentGroup = $this->findOneBy(['id' => $id, 'deletedAt' => null]);

        if (!$studentGroup) {
            throw new EntityNotFoundException(__('Student group not found'));
        }

        return $studentGroup;
    }
}
