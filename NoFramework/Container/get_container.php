<?php

use Axtiva\FlexibleGraphql\Builder\CodeGeneratorBuilderInterface;
use Axtiva\FlexibleGraphql\Builder\Foundation\CodeGeneratorBuilderFederated;
use Axtiva\FlexibleGraphql\Builder\Foundation\Psr\Container\TypeRegistryGeneratorBuilderFederated;
use Axtiva\FlexibleGraphql\Builder\TypeRegistryGeneratorBuilderInterface;
use Axtiva\FlexibleGraphql\Generator\Config\Foundation\Psr4\CodeGeneratorConfig;
use Axtiva\FlexibleGraphql\Generator\Config\LanguageLevelConfigInterface;
use Axtiva\FlexibleGraphql\Utils\FederationV22SchemaExtender;
use GraphQL\Language\Parser;
use GraphQL\Type\Schema;
use GraphQL\Utils\BuildSchema;
use SelfWritten\Container\Container;
use SelfWritten\GraphQL\Directive\HasRoleDirective;
use SelfWritten\GraphQL\Directive\IsAuthenticatedDirective;
use SelfWritten\GraphQL\Directive\PowDirective;
use SelfWritten\GraphQL\Representation\AccountRepresentation;
use SelfWritten\GraphQL\Representation\TransactionRepresentation;
use SelfWritten\GraphQL\Resolver\Account\TransactionsResolver;
use SelfWritten\GraphQL\Resolver\Mutation\CreateTransactionResolver;
use SelfWritten\GraphQL\Resolver\Query\_EntitiesResolver;
use SelfWritten\GraphQL\Resolver\Query\_ServiceResolver;
use SelfWritten\GraphQL\Resolver\Query\DateResolver;
use SelfWritten\GraphQL\Resolver\Query\DayTimeResolver;
use SelfWritten\GraphQL\Resolver\Query\SumResolver;
use SelfWritten\GraphQL\Scalar\DateTimeScalar;
use SelfWritten\GraphQL\UnionResolveType\_EntityTypeResolver;
use SelfWritten\GraphQL\UnionResolveType\TransactionLogTypeResolver;

$namespace = 'SelfWritten\GraphQL';
$dir = __DIR__ . '/../GraphQL';

$config = new CodeGeneratorConfig(
    $dir,
    LanguageLevelConfigInterface::V7_4,
    $namespace
);

$schemaGQL = file_get_contents(__DIR__ . '/../schema.graphql');

$ast = Parser::parse($schemaGQL);

return new Container([
    Schema::class => FederationV22SchemaExtender::build(BuildSchema::build($ast), $ast),
    CodeGeneratorBuilderInterface::class => (function() use ($config) {
        return new CodeGeneratorBuilderFederated($config);
    })(),
    TypeRegistryGeneratorBuilderInterface::class => new TypeRegistryGeneratorBuilderFederated($config),
    CreateTransactionResolver::class => new CreateTransactionResolver(),
    DateTimeScalar::class => new DateTimeScalar(),
    DateResolver::class => new DateResolver(),
    SumResolver::class => new SumResolver(),
    HasRoleDirective::class => new HasRoleDirective(),
    IsAuthenticatedDirective::class => new IsAuthenticatedDirective(),
    PowDirective::class => new PowDirective(),
    TransactionsResolver::class => new TransactionsResolver(),
    DayTimeResolver::class => new DayTimeResolver(),
    _EntityTypeResolver::class => new _EntityTypeResolver(),
    TransactionLogTypeResolver::class => new TransactionLogTypeResolver(),
    _EntitiesResolver::class => new _EntitiesResolver(...[new AccountRepresentation(), new TransactionRepresentation()]),
    _ServiceResolver::class => new _ServiceResolver($schemaGQL),
]);
