<?php

declare (strict_types=1);
namespace SelfWritten\GraphQL\Resolver\Mutation;

use GraphQL\Type\Definition\ResolveInfo;
use Axtiva\FlexibleGraphql\Resolver\ResolverInterface;
use SelfWritten\Entity\Transaction;
use SelfWritten\GraphQL\Mapper\EntityToGQLModel;
use SelfWritten\GraphQL\Model\TransactionType;
use SelfWritten\Repository\TransactionRepository;
use Symfony\Component\Uid\Uuid;

/**
 * This code is @generated by axtiva/flexible-graphql-php
 * This is resolver for Mutation.createTransaction
 */
final class CreateTransactionResolver implements ResolverInterface
{
    function __invoke($rootValue, $args, $context, ResolveInfo $info)
    {
        $transaction = new Transaction(Uuid::fromString($args['accountId']), $args['amount']);

        $destiny = rand(0,2); // Here some business logic
        switch($destiny) {
            case 0:
                $transaction->statusId = $transaction::STATUS_IN_PROGRESS;
                $transaction->log = [
                    ['code' => 111],
                    ['message' => 'asdf!'],
                ];
                break;
            case 1:
                $transaction->statusId = $transaction::STATUS_FAILED;
                $transaction->log = [
                    ['message' => 'Hello!'],
                    ['code' => 123],
                ];
                break;
            case 2:
                $transaction->statusId = $transaction::STATUS_SUCCESS;
                $transaction->log = [
                    ['code' => 42],
                    ['message' => 'World!'],
                ];
                break;
        }

        (new TransactionRepository())->insert($transaction);

        $response = new TransactionType();
        EntityToGQLModel::transaction($transaction, $response);

        return $response;
    }
}