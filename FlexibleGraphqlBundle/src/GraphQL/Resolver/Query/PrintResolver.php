<?php

declare (strict_types=1);
namespace App\GraphQL\Resolver\Query;

use Axtiva\FlexibleGraphql\Generator\Exception\NotImplementedResolver;
use GraphQL\Type\Definition\ResolveInfo;
use Axtiva\FlexibleGraphql\Resolver\ResolverInterface;

/**
 * This code is @generated by axtiva/flexible-graphql-php
 * This is resolver for Query.print
 */
final class PrintResolver implements ResolverInterface
{
    function __invoke($rootValue, $args, $context, ResolveInfo $info)
    {
        return $args['input'];
    }
}