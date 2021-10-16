<?php

namespace SelfWritten;

use GraphQL\Error\DebugFlag;
use GraphQL\Server\ServerConfig;
use GraphQL\Server\StandardServer;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use SelfWritten\GraphQL\Context;
use SelfWritten\GraphQL\TypeRegistry;

// execute in shell command on project root dir: composer install
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
} else {
    echo 'Autoloader did not generated, pls run command `composer install` on project root dir'; die;
}

$container = require __DIR__ . '/Container/get_container.php';

/**
 * Create schema from generated TypeRegistry
 */

$typeRegistry = new TypeRegistry($container);

$schema = new Schema([
    'query' => $typeRegistry->getType('Query'),
    'mutation' => $typeRegistry->getType('Mutation'),
    'typeLoader' => static function(string $name) use ($typeRegistry) : Type {
        return $typeRegistry->getType($name);
    },
]);

$user = ['username' => 'asdf', 'role' => 'admin'];

$debugFlag = DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE | DebugFlag::RETHROW_INTERNAL_EXCEPTIONS | DebugFlag::RETHROW_UNSAFE_EXCEPTIONS;
$config = ServerConfig::create()
    ->setSchema($schema)
    ->setDebugFlag($debugFlag)
    ->setContext(new Context($user))
;
$server = new StandardServer($config);
$server->handleRequest();