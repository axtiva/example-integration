<?php

declare (strict_types=1);
namespace App\GraphQL\Resolver\Query;

use App\GraphQL\Mapper\EntityToGQLModel;
use App\GraphQL\Model\AccountType;
use App\Repository\AccountRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Axtiva\FlexibleGraphql\Resolver\ResolverInterface;

/**
 * This code is @generated by axtiva/flexible-graphql-php
 * This is resolver for Query.account
 */
final class AccountResolver implements ResolverInterface
{
    private AccountRepository $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function __invoke($rootValue, $args, $context, ResolveInfo $info)
    {
        $entity = $this->accountRepository->find($args['id']);
        if (empty($entity)) {
            return null;
        }

        $response = new AccountType();
        EntityToGQLModel::account($entity, $response);

        return $response;
    }
}