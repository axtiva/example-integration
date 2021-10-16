<?php

namespace SelfWritten;

use Axtiva\FlexibleGraphql\Builder\CodeGeneratorBuilderInterface;
use Axtiva\FlexibleGraphql\FederationExtension\FederationSchemaExtender;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Schema;
use GraphQL\Utils\BuildSchema;
use Psr\Container\ContainerInterface;

// execute in shell command on project root dir: composer install
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
} else {
    echo 'Autoloader did not generated, pls run command `composer install` on project root dir'; die;
}

/** @var ContainerInterface $container */
$container = require __DIR__ . '/Container/get_container.php';

$typeName = 'Account';
$fieldName = 'transactions';

$schema = $container->get(Schema::class);

/** @var CodeGeneratorBuilderInterface $codeBuilder */
$codeBuilder = $container->get(CodeGeneratorBuilderInterface::class);
$codeGenerator = $codeBuilder->build();

/** @var ObjectType $type */
$type = $schema->getType($typeName);
$codeGenerator->generateFieldResolver($type, $type->getField($fieldName), $schema);
