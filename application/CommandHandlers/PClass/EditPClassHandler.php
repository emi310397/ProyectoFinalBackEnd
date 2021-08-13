<?php

declare(strict_types=1);

namespace Application\CommandHandlers\PClass;

use Application\Commands\PClass\EditPClassCommand;
use DateTime;
use Domain\Interfaces\Repositories\PClassRepositoryInterface;

class EditPClassHandler
{
    private PClassRepositoryInterface $PClassRepository;

    public function __construct(
        PClassRepositoryInterface $PClassRepository
    ) {
        $this->PClassRepository = $PClassRepository;
    }

    public function handle(EditPClassCommand $command): void
    {
        $PClass = $command->getPClass();

        $command->getSubject() ? $PClass->setSubject($command->getSubject()) : null;
        $command->getDescription() ? $PClass->setDescription($command->getDescription()) : null;
        $PClass->setUpdatedAt(new DateTime());

        $this->PClassRepository->update();
    }
}
