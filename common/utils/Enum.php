<?php
namespace Common\utils;

use InvalidArgumentException;
use ReflectionClass;

abstract class Enum
{
    /**
     * Constants cache
     *
     * @var array
     */
    protected static array $constants;

    /**
     * Return all possible values of this enum
     *
     * @return array
     */
    public static function all() : array
    {
        $selfClass = get_called_class();

        $reflection = new ReflectionClass($selfClass);
        $selfClass::$constants = $reflection->getConstants();

        return array_values($selfClass::$constants);
    }

    /**
     * Check if specified value is contained in this enumeration
     *
     * @param string|int $value
     *
     * @return boolean
     */
    public static function contains($value)
    {
        $selfClass = get_called_class();
        return in_array($value, $selfClass::all());
    }

    public static function containsMultiple(array $values): bool
    {
        $invalidValues = array_diff($values, static::all());

        return empty($invalidValues);
    }

    /**
     * Assert that the value belongs to this enum.
     *
     * @param mixed $value Value to be checked
     *
     * @throws InvalidArgumentException If the value doesn't belong to this enum
     */
    public static function assertContains($value)
    {
        if (!static::contains($value)) {
            $shortName = static::getShortName();

            throw new InvalidArgumentException('The input value doesn\'t belong to ' . $shortName);
        }
    }

    /**
     * Assert that the values belongs all of them to this enum.
     *
     * @param array $values Values to be checked.
     * @param string|null $errorMessage Message to show if it fails.
     *
     * @throws InvalidArgumentException If the value doesn't belong to this enum
     */
    public static function assertContainsMultiple(array $values, ?string $errorMessage = null)
    {
        if (! self::containsMultiple($values)) {
            $invalidValues = array_diff($values, static::all());

            if (is_null($errorMessage)) {
                $shortName = static::getShortName();

                throw new InvalidArgumentException('The following values don\'t belong to ' . $shortName . ' : ' . implode(', ', $invalidValues));
            } else {
                throw new InvalidArgumentException($errorMessage);
            }

        }
    }

    /**
     * Get short name of called class
     *
     * @return string
     */
    private static function getShortName()
    {
        $selfClass = get_called_class();

        $reflection = new ReflectionClass($selfClass);

        return $reflection->getShortName();
    }
}
