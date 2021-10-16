<?php

namespace App\Doctrine\Type;

use App\Enum\AccountStatus;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class AccountStatusEnum extends IntegerType
{
    public function getName()
    {
        return 'account_status_enum';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : new AccountStatus((int) $value);
    }

    /**
     * @param ?AccountStatus $value
     * @param AbstractPlatform $platform
     * @return mixed|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : $value->getValue();
    }
}