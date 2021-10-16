<?php

declare (strict_types=1);

namespace App\GraphQL\Mapper;

use App\Entity\Account;
use App\Entity\CodedCurrency;
use App\Entity\NamedCurrency;
use App\GraphQL\Model\AccountStatusEnum;
use App\GraphQL\Model\AccountType;
use App\GraphQL\Model\CodedCurrencyType;
use App\GraphQL\Model\NamedCurrencyType;

class EntityToGQLModel
{
    public static function account(Account $from, AccountType $to): void
    {
        $to->id = $from->getId()->toRfc4122();
        $to->amount = $from->getAmount();
        $to->number = $from->getNumber();
        $to->status = new AccountStatusEnum($from->getStatus()->getKey());
        if ($from->getNamedCurrency()) {
            $currency = new NamedCurrencyType();
            EntityToGQLModel::namedCurrency($from->getNamedCurrency(), $currency);
        } else {
            $currency = new CodedCurrencyType();
            EntityToGQLModel::codedCurrency($from->getCodedCurrency(), $currency);
        }
        $to->currency = $currency;

        $to->createdAt = $from->getCreatedAt();
    }

    public static function codedCurrency(CodedCurrency $from, CodedCurrencyType $to): void
    {
        $to->code = $from->getCode();
    }

    public static function namedCurrency(NamedCurrency $from, NamedCurrencyType $to): void
    {
        $to->name = $from->getName();
    }
}