<?php

namespace App\Enums;

use ReflectionClass;

abstract class Enum
{
    private static array $constCacheArray = [];

    public static function getKeys(): array
    {
        return array_keys(self::getConstants());
    }

    public static function getValues(): array
    {
        return array_values(self::getConstants());
    }

    public static function getValue($key)
    {
        $constraints = self::getConstants();

        return $constraints[$key] ?? null;
    }

    public static function getValueString($name): string
    {
        if (self::isValidName($name)) {
            $constants = self::getConstants();
            return $constants[$name];
        }

        return '';
    }

    public static function isValidName($name, $strict = false): bool
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value, $strict = true): bool
    {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict);
    }

    private static function getConstants()
    {
        $calledClass = static::class;

        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }
}
