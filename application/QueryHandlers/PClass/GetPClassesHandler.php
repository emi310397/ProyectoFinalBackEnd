<?php

declare(strict_types=1);

namespace Application\QueryHandlers\PClass;

use Application\Queries\PClass\GetPClassesQuery;
use Application\Results\PClass\PClassesResult;
use Application\Results\PClass\PClassResult;
use Domain\Interfaces\Repositories\PClassRepositoryInterface;

class GetPClassesHandler
{
    private PClassRepositoryInterface $PClassRepository;

    public function __construct(
        PClassRepositoryInterface $PClassRepository
    ) {
        $this->PClassRepository = $PClassRepository;
    }

    public function handle(GetPClassesQuery $command): PClassesResult
    {
        $PClassesResults = [];
        $user = $command->getUser();

        $PClasses = $this->PClassRepository->getAllByUser($user);

        foreach ($PClasses as $PClass) {
            $PClassesResults[] = new PClassResult($PClass);
        }

        return new PClassesResult($PClassesResults);
    }
}
