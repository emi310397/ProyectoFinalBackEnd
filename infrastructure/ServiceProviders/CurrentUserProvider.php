<?php
declare(strict_types=1);

namespace Infrastructure\ServiceProviders;

use Application\Services\User\CurrentUser;
use Domain\Interfaces\CurrentUserInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CurrentUserProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton(CurrentUserInterface::class, static function () {
            return new CurrentUser();
        });
    }

    public function provides()
    {
        return [
            CurrentUserInterface::class,
        ];
    }
}
