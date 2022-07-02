<?php

declare (strict_types=1);
namespace SelfWritten\GraphQL\DirectiveArgs;

use Axtiva\FlexibleGraphql\Type\InputType;

/**
 * This code is @generated by axtiva/flexible-graphql-php do not edit it
 * PHP representation of graphql directive args of pow
 * @property int $ex 
 */
final class PowDirectiveArgs extends InputType
{
    protected function decorate($name, $value)
    {
        if ($value === null) {
            return null;
        }

        return $value;
    }
}