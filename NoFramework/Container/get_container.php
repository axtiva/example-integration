<?php

use Axtiva\FlexibleGraphql\Builder\CodeGeneratorBuilderInterface;
use Axtiva\FlexibleGraphql\Builder\Foundation\CodeGeneratorBuilder;
use Axtiva\FlexibleGraphql\Builder\Foundation\Psr\Container\TypeRegistryGeneratorBuilder;
use Axtiva\FlexibleGraphql\Builder\TypeRegistryGeneratorBuilderInterface;
use Axtiva\FlexibleGraphql\Federation\Generator\Config\Foundation\Psr4\FederationRepresentationResolverGeneratorConfig;
use Axtiva\FlexibleGraphql\Federation\Generator\Model\Foundation\Psr4\_EntitiesResolverGenerator;
use Axtiva\FlexibleGraphql\Federation\Generator\Model\Foundation\Psr4\_ServiceResolverGenerator;
use Axtiva\FlexibleGraphql\Federation\Generator\Model\Foundation\Psr4\FederationRepresentationResolverGenerator;
use Axtiva\FlexibleGraphql\FederationExtension\FederationSchemaExtender;
use Axtiva\FlexibleGraphql\Generator\Config\Foundation\Psr4\CodeGeneratorConfig;
use Axtiva\FlexibleGraphql\Generator\Config\Foundation\Psr4\FieldResolverGeneratorConfig;
use Axtiva\FlexibleGraphql\Generator\Config\LanguageLevelConfigInterface;
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
use SelfWritten\GraphQL\Resolver\Query\_entitiesResolver;
use SelfWritten\GraphQL\Resolver\Query\_serviceResolver;
use SelfWritten\GraphQL\Resolver\Query\DateResolver;
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

return new Container([
    Schema::class => FederationSchemaExtender::build(BuildSchema::build($schemaGQL)),
    CodeGeneratorBuilderInterface::class => (function() use ($config) {
        $fieldResolverConfig = new FieldResolverGeneratorConfig($config);
        $federationRepresentationResolverConfig = new FederationRepresentationResolverGeneratorConfig($config);
        $builder = new CodeGeneratorBuilder($config);
        $builder->addFieldResolverGenerator(new _EntitiesResolverGenerator($fieldResolverConfig));
        $builder->addFieldResolverGenerator(new _ServiceResolverGenerator($fieldResolverConfig));
        $builder->addModelGenerator(new FederationRepresentationResolverGenerator($federationRepresentationResolverConfig));
        return $builder;
    })(),
    TypeRegistryGeneratorBuilderInterface::class => new TypeRegistryGeneratorBuilder($config),
    CreateTransactionResolver::class => new CreateTransactionResolver(),
    DateTimeScalar::class => new DateTimeScalar(),
    DateResolver::class => new DateResolver(),
    SumResolver::class => new SumResolver(),
    HasRoleDirective::class => new HasRoleDirective(),
    IsAuthenticatedDirective::class => new IsAuthenticatedDirective(),
    PowDirective::class => new PowDirective(),
    TransactionsResolver::class => new TransactionsResolver(),
    _EntityTypeResolver::class => new _EntityTypeResolver(),
    TransactionLogTypeResolver::class => new TransactionLogTypeResolver(),
    _entitiesResolver::class => new _entitiesResolver(...[new AccountRepresentation(), new TransactionRepresentation()]),
    _serviceResolver::class => new _serviceResolver($schemaGQL),
]);
