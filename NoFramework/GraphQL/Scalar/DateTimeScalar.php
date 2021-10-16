<?php

declare (strict_types=1);
namespace SelfWritten\GraphQL\Scalar;

use DateTimeImmutable;
use GraphQL\Language\AST\Node;
use Axtiva\FlexibleGraphql\Resolver\CustomScalarResolverInterface;

/**
 * This code is @generated by axtiva/flexible-graphql-php
 * This is resolver for scalar DateTime
 */
final class DateTimeScalar implements CustomScalarResolverInterface
{
    public function serialize($value)
    {
        return $value->format(DateTimeImmutable::ISO8601);
    }

    public function parseValue($value)
    {
        return $value ? new DateTimeImmutable($value) : null;
    }

    public function parseLiteral(Node $value, ?array $variables = null)
    {
        return $value->value ? new DateTimeImmutable((string) $value->value) : null;
    }
}