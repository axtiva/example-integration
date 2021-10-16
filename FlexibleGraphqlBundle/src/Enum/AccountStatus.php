<?php

namespace App\Enum;

use MyCLabs\Enum\Enum;

class AccountStatus extends Enum
{
    public const ACTIVE = 1;
    public const BLOCKED = 0;
}