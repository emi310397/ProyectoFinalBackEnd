<?php
namespace Common\objects;

use ReflectionClass;
use ReflectionProperty;
use ReflectionException;

class MemberAccessor
{
    /**
     * Get property of a subject class or object
     *
     * @param   string|object   $subject        Subject object or class
     * @param   string          $propertyName   Property name
     *
     * @return mixed
     *
     * @throws ReflectionException
     */
    public static function get($subject, $propertyName)
    {
        $property = static::getPropertyOf($subject, $propertyName);

        return $property->isStatic() ?
            $property->getValue() :
            $property->getValue($subject);
    }

    /**
     * Set property to a subject class or object
     *
     * @param   string|object   $subject        Subject object or class
     * @param   string          $propertyName   Property name
     * @param   mixed           $value          Value
     *
     * @return void
     *
     * @throws ReflectionException
     */
    public static function set($subject, $propertyName, $value)
    {
        $property = static::getPropertyOf($subject, $propertyName);

        if ($property->isStatic()) {
            $property->setValue($value);
        } else {
            $property->setValue($subject, $value);
        }
    }

    /**
     * Get reflection property of a subject
     *
     * @param   string|object   $subject        Subject object or class
     * @param   string          $propertyName   Property name
     *
     * @return ReflectionProperty
     *
     * @throws ReflectionException
     */
    private static function getPropertyOf($subject, $propertyName)
    {
        if (is_string($subject) && class_exists($subject)) {
            $class = new ReflectionClass($subject);
        } else {
            $class = new ReflectionClass(get_class($subject));
        }

        $property = $class->getProperty((string) $propertyName);
        $property->setAccessible(true);

        return $property;
    }
}
