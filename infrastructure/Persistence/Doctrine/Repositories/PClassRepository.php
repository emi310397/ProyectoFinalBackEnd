<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\PClass;
use Domain\Interfaces\Repositories\PClassRepositoryInterface;

/**
 * Class PClassRepository
 *
 * Inherited method signature rewriting:
 *
 * @method PClass[]  findAll()
 * @method PClass  find($id, $lockMode = null, $lockVersion = null)
 * @method PClass[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method null|PClass    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method PClass         save(PClass $PClass)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */
class PClassRepository extends BaseRepository implements PClassRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(PClass::class));
    }

    public function getByIdOrFail(int $id): PClass
    {
        $PClass = $this->findOneBy(['id' => $id, 'deletedAt' => null]);

        if (!$PClass) {
            throw new EntityNotFoundException(__('PClass not found'));
        }

        return $PClass;
    }
}
