<?php

declare(strict_types=1);

namespace Application\QueryHandlers\StudentGroup;

use Application\Queries\StudentGroup\GetStudentGroupsQuery;
use Application\Results\StudentGroup\StudentGroupsResult;
use Application\Validators\Course\UserToCourseMembershipValidator;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;

class GetStudentGroupsHandler
{
    private UserToCourseMembershipValidator $validator;
    private StudentGroupRepositoryInterface $studentGroupRepository;

    public function __construct(
        UserToCourseMembershipValidator $validator,
        StudentGroupRepositoryInterface $studentGroupRepository
    ) {
        $this->validator = $validator;
        $this->studentGroupRepository = $studentGroupRepository;
    }

    public function handle(GetStudentGroupsQuery $query): StudentGroupsResult
    {
        $course = $query->getCourse();

        $this->validator->validateCurrentUser($course);

        $studentGroups = $this->studentGroupRepository->getAllByCourse($course);

        return new StudentGroupsResult($studentGroups);
    }
}
