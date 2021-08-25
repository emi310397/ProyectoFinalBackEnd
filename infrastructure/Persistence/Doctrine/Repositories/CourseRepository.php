<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Repositories;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Domain\Entities\Course;
use Domain\Interfaces\Repositories\CourseRepositoryInterface;

/**
 * Class CourseRepository
 *
 * Inherited method signature rewriting:
 *
 * @method Course[]  findAll()
 * @method Course  find($id, $lockMode = null, $lockVersion = null)
 * @method Course[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method null|Course    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Course         save(Course $course)
 *
 * @package Infrastructure\Persistence\Doctrine\Repositories
 */
class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Course::class));
    }

    public function getByIdOrFail(int $id): Course
    {
        $course = $this->findOneBy(['id' => $id, 'deletedAt' => null]);

        if (!$course) {
            throw new EntityNotFoundException(__('Course not found'));
        }

        return $course;
    }
}
