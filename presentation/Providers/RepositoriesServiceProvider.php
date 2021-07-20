<?php

declare(strict_types=1);

namespace Presentation\Providers;

use Common\utils\ClassFinder;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

class RepositoriesServiceProvider extends ServiceProvider
{
    private const REPOSITORIES_NAMESPACE = '/domain/Interfaces/Repositories';
    private const IMPLEMENTATION_NAMESPACE = 'Infrastructure\\Persistence\\Doctrine\\Repositories\\';

    protected static array $repositoriesCache = [];

    public function register()
    {
        $mappings = $this->getMappings();

        array_map([$this->app, 'bind'], array_keys($mappings), array_values($mappings));
    }

    private function getMappings(): array
    {
        if (! empty(static::$repositoriesCache)) {
            return static::$repositoriesCache;
        }

        $classFinder = new ClassFinder();
        $repositoriesInterfaces = $classFinder->findClasses(base_path() . self::REPOSITORIES_NAMESPACE);

        $mappings = [];

        foreach ($repositoriesInterfaces as $repositoryInterface) {
            $interface = new ReflectionClass($repositoryInterface);
            $implementationName = preg_replace('/Interface$/', '', $interface->getShortName());
            $concreteClass = self::IMPLEMENTATION_NAMESPACE . $implementationName;

            $mappings[$repositoryInterface] = $concreteClass;
        }

        static::$repositoriesCache = $mappings;

        return $mappings;
    }
}
