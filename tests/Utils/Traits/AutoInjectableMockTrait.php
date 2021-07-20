<?php

namespace Tests\Utils\Traits;

use ReflectionClass;
use ReflectionException;
use Mockery as m;

trait AutoInjectableMockTrait
{
    /**
     * Auto inject mocked dependencies.
     *
     * @param string $className    Class name
     * @param array  $customParams Custom parameters
     * @param bool   $allSpied     All mocks are spied
     *
     * @return mixed
     * @throws ReflectionException
     */
    public static function autoInjectMocks($className, $customParams = [], bool $allSpied = false)
    {
        $class = new ReflectionClass($className);

        $constructorParams = $class->getConstructor()->getParameters();

        $constructorArgs = [];
        foreach ($constructorParams as $param) {
            $paramName = $param->getName();

            if (isset($customParams[$paramName])) {
                $constructorArgs[] = $customParams[$paramName];
            } elseif ($paramClass = $param->getClass()) {
                $constructorArgs[] = !$allSpied ? m::mock($paramClass->getName()) : m::spy($paramClass->getName());
            } elseif ($param->isDefaultValueAvailable()) {
                $constructorArgs[] = $param->getDefaultValue();
            }
        }

        return $class->newInstanceArgs($constructorArgs);
    }
}
