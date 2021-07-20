<?php
declare(strict_types=1);

namespace Infrastructure\CommandBus;

use League\Tactician\Exception\MissingHandlerException;
use League\Tactician\Handler\Locator\HandlerLocator;

final class HandlerClassNameLocator implements HandlerLocator
{
    /**
     * @var string
     */
    private const NAMESPACE_SEP = '\\';

    /**
     * @var string
     */
    private const HANDLER_SUFFIX = 'Handler';

    /**
     * @var string
     */
    private $handlersNameSpace;

    /**
     * @var callable
     */
    private $containerResolver;

    public function __construct(string $handlersNameSpace, Callable $containerResolver)
    {
        $this->handlersNameSpace = $handlersNameSpace;
        $this->containerResolver = $containerResolver;
    }

    /**
     * Retrieves the handler for a specified command
     *
     * @param string $commandName
     *
     * @return object
     *
     * @throws MissingHandlerException
     */
    public function getHandlerForCommand($commandName)
    {
        $callback = $this->containerResolver;

        return $callback($this->getHandlerClassName($commandName));
    }

    /**
     * Returns the full qualified class name of handler class
     *
     * @param string $commandName
     *
     * @return string
     */
    private function getHandlerClassName(string $commandName): string
    {
        return $this->handlersNameSpace . self::NAMESPACE_SEP . $commandName . self::HANDLER_SUFFIX;
    }
}
