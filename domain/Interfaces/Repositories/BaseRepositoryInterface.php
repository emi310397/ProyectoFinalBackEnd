<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

interface BaseRepositoryInterface
{
    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     * @param int|null $lockMode One of the \Doctrine\DBAL\LockMode::* constants
     *                              or NULL if no specific lock mode should be used
     *                              during the search.
     * @param int|null $lockVersion The lock version.
     *
     * @return array The entity instance or NULL if the entity can not be found.
     */
    public function findAll();

    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     * @param int|null $lockMode One of the \Doctrine\DBAL\LockMode::* constants
     *                              or NULL if no specific lock mode should be used
     *                              during the search.
     * @param int|null $lockVersion The lock version.
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function find($id, $lockMode = null, $lockVersion = null);

    /**
     * Finds an entity in the repository.
     *
     * @return object The entities.
     *
     * @throws EntityNotFoundException
     */
    public function findOrFail($id, $lockMode = null, $lockVersion = null);

    /**
     * Finds entities by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return array The objects.
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function findOneBy(array $criteria, array $orderBy = null);

    /**
     * Saves an object into a relational schema
     *
     * @param $entity
     *
     * @return mixed
     */
    public function save($entity);

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(): void;

    /**
     * Delete an object in the repository
     *
     * @param $entity
     */
    public function delete($entity): void;
}
