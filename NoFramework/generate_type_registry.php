<?php

namespace SelfWritten;

use Axtiva\FlexibleGraphql\Builder\CodeGeneratorBuilderInterface;
use Axtiva\FlexibleGraphql\Builder\TypeRegistryGeneratorBuilderInterface;
use Axtiva\FlexibleGraphql\FederationExtension\FederationSchemaExtender;
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

$schema = $container->get(Schema::class);

$codeBuilder = $container->get(CodeGeneratorBuilderInterface::class);
$generatorCode = $codeBuilder->build();
foreach ($generatorCode->generateAllTypes($schema) as $code);

$registryBuilder = $container->get(TypeRegistryGeneratorBuilderInterface::class);
$generatorRegistry = $registryBuilder->build();

$typeRegistryCode = $generatorRegistry->generate($schema);
/** Generate TypeRegistry into file */
file_put_contents($generatorRegistry->getConfig()->getTypeRegistryClassFileName(), $typeRegistryCode);