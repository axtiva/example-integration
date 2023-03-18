<?php

declare (strict_types=1);
namespace App\GraphQL\Directive;

use GraphQL\Error\UserError;
use GraphQL\Type\Definition\ResolveInfo;
use Axtiva\FlexibleGraphql\Resolver\DirectiveResolverInterface;

/**
 * This code is @generated by axtiva/flexible-graphql-php
 * Resolver for executable directive @isAuthenticated
 */
final class IsAuthenticatedDirective implements DirectiveResolverInterface
{
    function __invoke(callable $next, $directiveArgs, $rootValue, $args, $context, ResolveInfo $info)
    {
        $user = $context->getUser();

        if (empty($user)) {
            throw new UserError('Authentication required');
        }

        return $next($rootValue, $args, $context, $info);
    }
}