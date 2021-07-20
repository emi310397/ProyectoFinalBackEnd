<?php

declare(strict_types=1);

namespace Infrastructure\ServiceProviders;

use Presentation\Services\RedisClient;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Interfaces\RedisClientInterface;

class RedisClientProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton(
            RedisClientInterface::class,
            static function () {
                return new RedisClient();
            }
        );
    }

    public function provides()
    {
        return [
            RedisClientInterface::class,
        ];
    }
}
