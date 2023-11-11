<?php

namespace App\Enums;

use App\Enums\EnumBase;



class TransactionStatus extends EnumBase
{
	const OUTSTANDING = 0;
	const OVERDUE = 1;
	const PAID = 2;

	protected static $constants = [
		self::OUTSTANDING,
		self::OVERDUE,
		self::PAID,
	];
}
