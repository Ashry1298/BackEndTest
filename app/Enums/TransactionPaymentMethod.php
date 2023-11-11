<?php

namespace App\Enums;


class TransactionPaymentMethod
{
    const CREDIT_CARD = 0;
    const DEBIT_CARD = 1;
    const PAYPAL = 2;
    const BANK_TRANSFER = 3;


    protected static $constants = [
        self::CREDIT_CARD,
        self::DEBIT_CARD,
        self::PAYPAL,
        self::BANK_TRANSFER,
    ];
}
