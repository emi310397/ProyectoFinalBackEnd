<?php

declare(strict_types=1);

namespace Tests\Integration;

use Application\Services\Email\EmailDispatcherServiceInterface;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Foundation\Application;
use Infrastructure\Interfaces\RedisClientInterface;
use Mockery as m;
use Predis\Client;
use Tests\TestCase;
use Tests\Utils\Handlers\TestErrorHandler;
use Tests\Utils\Traits\Database\DatabasePreparerTrait;
use Tests\Utils\Traits\Fixtures\FixtureLoaderTrait;

abstract class IntegrationTestCase extends TestCase
{
    use DatabasePreparerTrait;
    use FixtureLoaderTrait;

    /** @var Application */
    protected $app;

    public function setUp(): void
    {
        parent::setUp();

        $this->prepareDatabase();
        $this->loadFixturesFromProvider();
        $this->mockEmailJobDispatcher();
        $this->mockRedisConnection();
    }

    protected function disableErrorHandling(): void
    {
        $this->app->instance(ExceptionHandler::class, new TestErrorHandler());
    }

    private function mockEmailJobDispatcher(): void
    {
        $emailJobDispatcherService = m::mock(EmailDispatcherServiceInterface::class);
        $emailJobDispatcherService->shouldReceive('dispatch');

        $this->app->instance(EmailDispatcherServiceInterface::class, $emailJobDispatcherService);
    }

    private function mockRedisConnection(): void
    {
        $redisClient = m::mock(Client::class);
        $redisClient->shouldReceive('set');
        $redisClient->shouldReceive('get')->andReturn(null);
        $redisClient->shouldReceive('executeCommand')->andReturn(null);
        $redisClient->shouldReceive('expire');

        $redisClientProvider = m::mock(RedisClientInterface::class);
        $redisClientProvider->shouldReceive('getClient')->andReturn($redisClient);

        $this->app->instance(RedisClientInterface::class, $redisClientProvider);
        $this->app->instance(Client::class, $redisClient);
    }
}
