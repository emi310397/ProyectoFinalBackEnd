<?php
declare(strict_types=1);

namespace Infrastructure\QueryBus;

use Illuminate\Support\Str;
use InvalidArgumentException;
use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor as CommandNameExtractorInterface;

final class QueryNameExtractor implements CommandNameExtractorInterface
{
    /**
     * The suffix of query class name
     *
     * @var string
     */
    private const QUERY_SUFFIX = 'Query';

    /**
     * @var string
     */
    private $commandsNamespace;

    /**
     * CommandNameExtractor constructor.
     *
     * @param string|null $commandsNamespace
     */
    public function __construct(string $commandsNamespace = null)
    {
        if (!empty($commandsNamespace) && !Str::endswith($commandsNamespace, '\\')) {
            $commandsNamespace .= '\\';
        }

        $this->commandsNamespace = $commandsNamespace;
    }

    /**
     * Extract the name from a command
     *
     * @param object $command
     *
     * @return string
     */
    public function extract($command)
    {
        if (!is_object($command)) {
            throw new InvalidArgumentException('Cannot determine the command name of a non-object parameter');
        }

        $name = Str::replaceLast(self::QUERY_SUFFIX, '', get_class($command));

        return str_replace($this->commandsNamespace, '', $name);
    }
}
