<?php

declare(strict_types=1);

namespace Domain\Interfaces\Repositories;

use Domain\Entities\Assignment;
use Domain\Entities\Student;
use Domain\Entities\Task;

/**
 * Interface AssignmentRepositoryInterface
 *
 * Inherited method signature rewriting:
 *
 * @method Assignment[]       findAll()
 * @method null|Assignment    find($id, $lockMode = null, $lockVersion = null)
 * @method Assignment[]  findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Assignment    findOneBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Assignment         save(Assignment $assignment)
 *
 * @package Domain\Interfaces\Repositories
 */
interface AssignmentRepositoryInterface extends BaseRepositoryInterface
{
    public function getByIdOrFail(int $id): Assignment;

    public function getAllByStudent(Student $student): array;

    public function getAllByTask(Task $task): array;
}
