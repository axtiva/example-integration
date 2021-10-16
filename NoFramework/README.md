# No framework integration

## First step

## First step

Composer install:

```shell
composer install
```

Generate models and type registry:

```shell
php generate_type_registry.php
```

Generate Directive resolver for executable directives:

Change $directiveName variable for name of schema directive, for make it executable

```shell
php generate_directive_resolver.php
```

Generate Field Resolver:

Change $typeName and $fieldName into file for generate field resolver

```shell
php generate_field_resolver.php
```

Generate Scalar Resolver:

Change $scalarTypeName into file for generate scalar resolver

```shell
php generate_scalar_resolver.php
```