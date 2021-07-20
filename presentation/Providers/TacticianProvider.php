<?php

declare(strict_types=1);

namespace Presentation\Providers;

use Domain\CommandBus\CommandBusInterface;
use Domain\QueryBus\QueryBusInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Infrastructure\CommandBus\CommandBus;
use Infrastructure\CommandBus\CommandNameExtractor;
use Infrastructure\CommandBus\HandlerClassNameLocator;
use Infrastructure\QueryBus\QueryBus;
use Infrastructure\QueryBus\QueryNameExtractor;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;

class TacticianProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CommandBusInterface::class, function (Container $container) {
            $commandNameExtractor = new CommandNameExtractor(config('app.command_bus.commands_namespace'));

            $diStrategy = function ($handlerClassName) use ($container) {
                return $container->make($handlerClassName);
            };

            $handlerClassNameLocator = new HandlerClassNameLocator(
                config('app.command_bus.handlers_namespace'),
                $diStrategy
            );

            $methodInflector = new HandleInflector();

            $middleware = new CommandHandlerMiddleware(
                $commandNameExtractor,
                $handlerClassNameLocator,
                $methodInflector
            );

            return new CommandBus([$middleware]);
        });

        $this->app->bind(QueryBusInterface::class, function (Container $container) {
            $queryNameExtractor = new QueryNameExtractor(config('app.query_bus.queries_namespace'));

            $diStrategy = function ($handlerClassName) use ($container) {
                return $container->make($handlerClassName);
            };

            $handlerClassNameLocator = new HandlerClassNameLocator(
                config('app.query_bus.handlers_namespace'),
                $diStrategy
            );

            $methodInflector = new HandleInflector();

            $middleware = new CommandHandlerMiddleware(
                $queryNameExtractor,
                $handlerClassNameLocator,
                $methodInflector
            );

            return new QueryBus([$middleware]);
        });
    }
}
