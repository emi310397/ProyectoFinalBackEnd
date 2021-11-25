<?php

declare(strict_types=1);

namespace Presentation\Providers;

use Application\Services\Email\EmailDispatcherService;
use Application\Services\Event\EventDispatcherService;
use Application\Services\Event\EventDispatcherServiceInterface;
use Domain\Services\EmailDispatcherServiceInterface;
use Illuminate\Support\ServiceProvider;
use Presentation\Interfaces\ValidatorServiceInterface;
use Presentation\Services\ValidatorService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ValidatorServiceInterface::class, ValidatorService::class);

        $this->app->bind(EventDispatcherServiceInterface::class, EventDispatcherService::class);

        $this->app->bind(EmailDispatcherServiceInterface::class, EmailDispatcherService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
