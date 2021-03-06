<?php

declare (strict_types=1);
namespace SelfWritten\GraphQL\Directive;

use GraphQL\Error\UserError;
use GraphQL\Type\Definition\ResolveInfo;
use Axtiva\FlexibleGraphql\Resolver\DirectiveResolverInterface;
use SelfWritten\GraphQL\DirectiveArgs\HasRoleDirectiveArgs;

/**
 * This code is @generated by axtiva/flexible-graphql-php
 * Resolver for executable directive @hasRole
 */
final class HasRoleDirective implements DirectiveResolverInterface
{
    /**
     * @param callable $next
     * @param HasRoleDirectiveArgs $directiveArgs
     * @param $rootValue
     * @param $args
     * @param $context
     * @param ResolveInfo $info
     * @return mixed
     */
    public function __invoke(callable $next, $directiveArgs, $rootValue, $args, $context, ResolveInfo $info)
    {
        $user = $context->getUser();

        if (empty($user) || $user['role'] !== $directiveArgs->role) {
            throw new UserError('Access denied');
        }

        return $next($rootValue, $args, $context, $info);
    }
}