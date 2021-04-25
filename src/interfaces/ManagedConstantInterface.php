<?php

/**
 * Trait to get managed constants data.
 */

namespace nickdenry\managedConstants\traits;

trait ManagedConstantTrait
{

    private static $attributes = '_ATTRIBUTES';

    public static function constants()
    {

        $reflection = new \ReflectionClass(static::class);
        $allConstants = $reflection->getConstants();

        $constants = [];
        foreach ($allConstants as $name => $value) {
            if ($name === self::$attributes) {
                continue;
            }
            $constants[$name] = $value;
        }
        return $constants;
    }

    public static function values()
    {
        return array_values(static::constants());
    }

    public static function listAttributes($constValue)
    {
        try {
            $descriptionArray = constant('static::' . self::$attributes);
        } catch (\Exception $ex) {
            throw new \Exception('const array _ATTRIBUTES is not set at the ' . static::class);
        }
        if (!array_key_exists($constValue, $descriptionArray)) {
            $constants = array_flip(self::getConstants());
            throw new \Exception('_ATTRIBUTE description for the const ' . $constants[$constValue] . ' is not set at the ' . static::class);
        }

        return $descriptionArray[$constValue];
    }

    public static function attribute($constValue, $attributeName)
    {
        $valueAttributes = self::listAttributes($constValue);
        if (!array_key_exists($attributeName, $valueAttributes)) {
            $constants = array_flip(self::getConstants());
            throw new \Exception('There is no _ATTRIBUTE enrty "' . $attributeName . '" for the const ' . $constants[$constValue] . ' at the ' . static::class);
        }
        return $valueAttributes[$attributeName];
    }

    public function getList()
    {
        $constValues = static::values();
        $constList = [];
        foreach ($constValues as $value) {
            $constList[] = array_merge(['id' => $value], static::listAttributes($value));
        }
        return $constList;
    }

}

