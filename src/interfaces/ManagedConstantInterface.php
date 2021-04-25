<?php

namespace nickdenry\managedConstants\interfaces;

interface ManagedConstantInterface
{

    /**
     * Return array off the class constants, except the _ATTRIBUTES one
     * ['ACTIVE' => 0, 'DONE' => 1]
     * @return array
     */
    public static function constants();

    /**
     * Get class constant values
     * [0, 1]
     * @return array
     */
    public static function values();

    /**
     * Get list of the constant attributes
     * ['label' => 'Constant related label', 'class' => 'Constant related class']
     * @param int|string $constValue constant value
     * @return array Constant value _ATTRIBUTES entry
     * @throws \Exception
     */
    public static function listAttributes($constValue);

    /**
     * Get constant attribute by it's name
     * i.e. value 'Constant related label'
     * @param int|string $constValue constant value
     * @param string $attributeName _ATTRIBUTES string attribute
     * @return mixed
     * @throws \Exception
     */
    public static function attribute($constValue, $attributeName);

    /**
     * Return array of the class constant with atributes like
     * ['id' => 0, 'label' => 'Some attribute label', 'class' => 'Constant related class']
     * @return array
     */
    public function getList();
}
