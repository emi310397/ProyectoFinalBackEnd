<?php

declare(strict_types=1);

namespace Application\CommandHandlers\PClass;

use Application\Commands\PClass\CreatePClassCommand;
use Domain\Entities\PClass;
use Domain\Interfaces\Repositories\PClassRepositoryInterface;

class CreatePClassHandler
{
    private PClassRepositoryInterface $PClassRepository;

    public function __construct(
        PClassRepositoryInterface $PClassRepository
    ) {
        $this->PClassRepository = $PClassRepository;
    }

    public function handle(CreatePClassCommand $command): void
    {
        $PClass = new PClass(
            $command->getSubject(),
            $command->getDescription(),
        );

        $this->PClassRepository->save($PClass);
    }
}
