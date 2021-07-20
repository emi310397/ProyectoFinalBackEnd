<?php

namespace Tests\Utils\Traits;

use Mockery\MockInterface;
use ProxyManager\Proxy\VirtualProxyInterface;
use Common\objects\MemberAccessor;

/**
 * Make private (or protected properties) accessible
 */
trait PrivateGetSet
{
    /**
     * Get property of a subject class or object
     *
     * @param   string|object   $subject        Subject object or class
     * @param   string          $propertyName   Property name
     *
     * @return MockInterface
     */
    protected function getProperty($subject, $propertyName)
    {
        $subject = $this->resolveProxiedDeps($subject);

        return MemberAccessor::get($subject, $propertyName);
    }

    /**
     * Set property to a subject class or object
     *
     * @param   string|object   $subject        Subject object or class
     * @param   string          $propertyName   Property name
     * @param   mixed           $value          Value
     *
     * @return void
     */
    protected function setProperty($subject, $propertyName, $value)
    {
        $subject = $this->resolveProxiedDeps($subject);

        MemberAccessor::set($subject, $propertyName, $value);
    }

    /**
     * Get dependency from container bypassing  proxy.
     *
     * Since ProxyManager hides private properties from it's Proxies we need to resolve them.
     *
     * @param mixed $dependency Dependency
     */
    protected function resolveProxiedDeps($dependency)
    {
        if (
            $dependency &&
            $dependency instanceof VirtualProxyInterface
        ) {
            $dependency->initializeProxy();
            $dependency = $dependency->getWrappedValueHolderValue();
        }

        return $dependency;
    }
}
