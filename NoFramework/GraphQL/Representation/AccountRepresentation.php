<?php

declare (strict_types=1);
namespace SelfWritten\GraphQL\Representation;

use GraphQL\Type\Definition\ResolveInfo;
use Axtiva\FlexibleGraphql\Federation\Representation;
use Axtiva\FlexibleGraphql\Federation\Resolver\FederationRepresentationResolverInterface;
use Axtiva\FlexibleGraphql\Generator\Exception\NotImplementedResolver;
use SelfWritten\GraphQL\Model\AccountType;

/**
 * This code is @generated by axtiva/flexible-graphql-php
 * Representation resolver for federated graphql type Account
 */
final class AccountRepresentation implements FederationRepresentationResolverInterface
{
    public function getTypeName(): string
    {
        return 'Account';
    }

    public function __invoke(Representation $representation, $context, ResolveInfo $info)
    {
        $response = new AccountType();
        $response->id = $representation->getFields()['id'];

        return $response;
    }
}