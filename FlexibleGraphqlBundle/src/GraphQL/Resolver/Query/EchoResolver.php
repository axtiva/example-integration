<?php

declare (strict_types=1);
namespace App\GraphQL\Resolver\Query;

use GraphQL\Type\Definition\ResolveInfo;
use Axtiva\FlexibleGraphql\Resolver\ResolverInterface;

/**
 * This code is @generated by axtiva/flexible-graphql-php
 * This is resolver for Query.echo
 */
final class EchoResolver implements ResolverInterface
{
    function __invoke($rootValue, $args, $context, ResolveInfo $info)
    {
        return $args['input'];
    }
}