<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use DateTime;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Domain\Interfaces\Repositories\BaseRepositoryInterface;
use InvalidArgumentException;

class BaseRepository extends EntityRepository implements BaseRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findAll()
    {
        return parent::findAll();
    }

    /**
     * @inheritDoc
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        if (is_array($id)) {
            throw new InvalidArgumentException('To find many entities use findMany method.');
        }

        return parent::find($id, $lockMode, $lockVersion);
    }

    /**
     * @inheritDoc
     */
    public function findOrFail($id, $lockMode = null, $lockVersion = null)
    {
        $entity = $this->find($id);

        if (empty($entity)) {
            throw new EntityNotFoundException('Entity ' . $this->_entityName . ' with id ' . $id . ' not found');
        }

        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritDoc
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    /**
     * @inheritDoc
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save($entity)
    {
        $this->checkIfEntityIsValid($entity);

        $this->_em->persist($entity);
        $this->_em->flush();

        return $entity;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(): void
    {
        $this->getEntityManager()->flush();
    }

    public function delete($entity): void
    {
        $entity->setDeletedAt(new DateTime());
        $this->update();
    }

    private function checkIfEntityIsValid($entity): void
    {
        if (is_a($entity, $this->_entityName) === false) {
            throw new InvalidArgumentException(
                sprintf("Can't save entity %s with repository %s", get_class($entity), $this->_entityName)
            );
        }
    }
}
