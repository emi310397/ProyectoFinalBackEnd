<?php

declare(strict_types=1);

namespace Application\CommandHandlers\PClass;

use Application\Commands\PClass\DeletePClassCommand;
use Domain\Interfaces\Repositories\PClassRepositoryInterface;

class DeletePClassHandler
{
    private PClassRepositoryInterface $PClassRepository;

    public function __construct(
        PClassRepositoryInterface $PClassRepository
    ) {
        $this->PClassRepository = $PClassRepository;
    }

    public function handle(DeletePClassCommand $command): void
    {
        $this->PClassRepository->delete($command->getPClass());
    }
}
