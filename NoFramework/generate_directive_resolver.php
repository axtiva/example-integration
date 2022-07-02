<?php

namespace SelfWritten;

use Axtiva\FlexibleGraphql\Builder\CodeGeneratorBuilderInterface;
use GraphQL\Type\Schema;
use Psr\Container\ContainerInterface;

// execute in shell command on project root dir: composer install
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
} else {
    echo 'Autoloader did not generated, pls run command `composer install` on project root dir'; die;
}

/** @var ContainerInterface $container */
$container = require __DIR__ . '/Container/get_container.php';

$directiveName = 'set_directive_name_here';

$schema = $container->get(Schema::class);

/** @var CodeGeneratorBuilderInterface $codeBuilder */
$codeBuilder = $container->get(CodeGeneratorBuilderInterface::class);

$codeGenerator = $codeBuilder->build();
$directive = $schema->getDirective($directiveName);
if ($directive === null) {
    throw new \RuntimeException('Directive not found ' . $directiveName);
}

foreach ($codeGenerator->generateDirectiveResolver($schema->getDirective($directiveName), $schema) as $code);
