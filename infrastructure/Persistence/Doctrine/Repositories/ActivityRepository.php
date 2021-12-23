<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Activity;
use Domain\Interfaces\Repositories\ActivityRepositoryInterface;

/**
 * Class ActivityRepository
 *
 * Inherited method signature rewriting:
 *
 * @method Activity[]  findAll()
 * @method Activity  find($id, $lockMode = null, $lockVersion = null)
 * @method Activity[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method null|Activity    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Activity         save(Activity $activity)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */
class ActivityRepository extends BaseRepository implements ActivityRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Activity::class));
    }

    public function getByIdOrFail(int $id): Activity
    {
        $activity = $this->findOneBy(['id' => $id, 'deletedAt' => null]);

        if (!$activity) {
            throw new EntityNotFoundException(__('Activity not found'));
        }

        return $activity;
    }
}
