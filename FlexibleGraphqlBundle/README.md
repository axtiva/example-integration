# Symfony framework integration

## First step

Composer install:

```shell
composer install
```

Generate models and type registry:

```shell
bin/console flexible_graphql:generate-type-registry
```

Generate Directive resolver for executable directives:

```shell
bin/console flexible_graphql:generate-directive-resolver directive_name
```

Generate Field Resolver:

```shell
bin/console flexible_graphql:generate-field-resolver type_name field_name
```

Generate Scalar Resolver:

```shell
bin/console flexible_graphql:generate-scalar-resolver scalar_name
```