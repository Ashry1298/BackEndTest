<?php

namespace App\Enums;


class TransactionPaymentMethod extends  EnumBase
{
    const CREDIT_CARD = 0;
    const Cash = 1;
    const BANK_TRANSFER = 2;




    protected static $constants = [
        'CREDIT_CARD' => 0,
        'CASH' => 1,
        'BANK_TRANSFER' => 2,
    ];


    public static function getNameByValue($key)
    {
        foreach (static::$constants as $constName => $constValue) {
            if ($constValue === $key) {
                return $constName;
            }
        }

        return null;
    }
}
