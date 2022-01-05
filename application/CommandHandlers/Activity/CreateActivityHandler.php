<?php

declare(strict_types=1);

namespace Application\CommandHandlers\Activity;

use Application\Commands\Activity\CreateActivityCommand;
use Domain\Entities\Activity;
use Domain\Interfaces\Repositories\ActivityRepositoryInterface;

class CreateActivityHandler
{
    private ActivityRepositoryInterface $activityRepository;

    public function __construct(
        ActivityRepositoryInterface $activityRepository
    ) {
        $this->activityRepository = $activityRepository;
    }

    public function handle(CreateActivityCommand $command): void
    {
        $activity = new Activity(
            $command->getTitle(),
            $command->getType(),
            $command->getDescription(),
            $command->getBody(),
            $command->getTask()
        );

        $this->activityRepository->save($activity);
    }
}
