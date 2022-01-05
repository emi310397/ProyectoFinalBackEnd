<?php

declare(strict_types=1);

namespace Application\QueryHandlers\StudentGroup;

use Application\Queries\StudentGroup\GetStudentGroupsQuery;
use Application\Results\StudentGroup\StudentGroupsResult;
use Application\Validators\Course\UserToCourseMembershipValidator;
use Domain\Interfaces\CurrentUserInterface;
use Domain\Interfaces\Repositories\StudentGroupRepositoryInterface;

class GetStudentGroupsHandler
{
    private CurrentUserInterface $currentUser;
    private UserToCourseMembershipValidator $validator;
    private StudentGroupRepositoryInterface $studentGroupRepository;

    public function __construct(
        CurrentUserInterface            $currentUser,
        UserToCourseMembershipValidator $validator,
        StudentGroupRepositoryInterface $studentGroupRepository
    )
    {
        $this->currentUser = $currentUser;
        $this->validator = $validator;
        $this->studentGroupRepository = $studentGroupRepository;
    }

    public function handle(GetStudentGroupsQuery $query): StudentGroupsResult
    {
        $currentUser = $this->currentUser->getUser();
        $course = $query->getCourse();

        $this->validator->validate($currentUser, $course);

        $studentGroups = $this->studentGroupRepository->getAllByCourse($course);

        return new StudentGroupsResult($studentGroups);
    }
}
