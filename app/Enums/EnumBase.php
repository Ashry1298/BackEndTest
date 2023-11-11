<?php
namespace App\Enums;

abstract class EnumBase
{

    protected static $constants = [];



    public static function isValidValue($value)
    {
        return in_array($value, static::$constants, true);
    }



    public static function getConstants()
    {
        return static::$constants;
    }
}
