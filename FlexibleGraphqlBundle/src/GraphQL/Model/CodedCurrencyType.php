<?php

declare (strict_types=1);
namespace App\GraphQL\Model;

use Axtiva\FlexibleGraphql\Resolver\AutoGenerationInterface;

/**
 * This code is @generated by axtiva/flexible-graphql-php
 * if you want to extend it or change, then remove interface AutoGenerationInterface
 * and it will be managed by you, not axtiva/flexible-graphql-php code generator
 * PHP representation of graphql type CodedCurrency
 */
final class CodedCurrencyType implements AutoGenerationInterface, CurrencyInterface, _EntityInterface
{
    public int $code;
    /**
     * @var iterable
     */
    public iterable $accounts;
}