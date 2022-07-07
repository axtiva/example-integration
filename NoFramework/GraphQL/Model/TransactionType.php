<?php

declare (strict_types=1);
namespace SelfWritten\GraphQL\Model;

use Axtiva\FlexibleGraphql\Resolver\AutoGenerationInterface;
use DateTimeImmutable;

/**
 * This code is @generated by axtiva/flexible-graphql-php
 * if you want to extend it or change, then remove interface AutoGenerationInterface
 * and it will be managed by you, not axtiva/flexible-graphql-php code generator
 * PHP representation of graphql type Transaction
 */
final class TransactionType implements AutoGenerationInterface, _EntityInterface
{
    public string $id;
    public int $amount;
    public TransactionStatusEnum $status;
    public AccountType $account;
    /**
     * @var null|iterable
     */
    public ?iterable $log = null;
    public DateTimeImmutable $createdAt;
}