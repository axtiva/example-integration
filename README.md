# Example Integration

Demo projects for flexible-graphql integration with different apps

## TL;DR

### Up Postgresql

```
docker-compose up -d postgresql
```

wait until they are ready

### Up services

```
docker-compose up -d flexible-graphql-bundle no-framework
```

wait until they are ready

### Up Apollo Federation

```
docker-compose up -d apollo-federation
```

send federated queries to http://localhost:8080/

## Symfony Bundle FlexibleGraphqlBundle

Command for generate TypeRegistry

```
php bin/console flexible_graphql:generate-type-registry
```

Run http server for handle GraphQL requests

```
php -S localhost:8080 FlexibleGraphqlBundle/index.php
```

## NoFramework 

Command for generate TypeRegistry

```
php NoFramework/generate.php
```

Run http server for handle GraphQL requests

```
php -S localhost:8080 NoFramework/index.php
```

## Apollo Federation Integration

install node.js

Install dependency

```
cd ApolloFederation
npm install
```

Run Apollo Federation

```
cd ApolloFederation
node index
```