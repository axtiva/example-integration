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

### Example queries

#### Create account

##### GraphQL

```graphql
mutation {
    createAccount(number: "asdfasdgas2") {
        id
        number
        currency {
            __typename
            ...on NamedCurrency {
                name
            }
            ...on CodedCurrency {
                code
            }
        }
    }
}
```

##### CURL

```shell
curl --request POST \
  --url http://localhost:8080/ \
  --header 'Content-Type: application/json' \
  --header 'X-AUTH-ROLE: watcher' \
  --header 'X-AUTH-USERNAME: asdf' \
  --data '{"query":"mutation {\n    createAccount(number: \"asdfasdgas2\") {\n    id\n    number\n    currency {\n      __typename\n      ...on NamedCurrency {\n        name\n      }\n      ...on CodedCurrency {\n        code\n      }\n    }\n  }\n}"}'
```

#### Create transaction in account

##### GraphQL

```graphql
mutation {
    createTransaction(accountId:"8026c5fd-4cda-4eda-8652-2bdcbf0f2e7f", amount: 222) {
        id
        amount
        status
    }
}
```

##### CURL

```shell
curl --request POST \
  --url http://localhost:8080/ \
  --header 'Content-Type: application/json' \
  --header 'X-AUTH-ROLE: watcher' \
  --header 'X-AUTH-USERNAME: asdf' \
  --data '{"query":"mutation {\n  createTransaction(accountId:\"8026c5fd-4cda-4eda-8652-2bdcbf0f2e7f\", amount: 222) {\n    id\n    amount\n    status\n  }\n}"}'
```

#### Fetch data from graph

##### GraphQL

```graphql
query{
  currentUser {
    username
    role
  }
  mod(input: {x: 11, y: 4})
  sum(sumInput: {x: 2, y: 3})
  echo(input: "Hello")
  print(input: "Hello")
	dayTime(timestamps: [
		[{
			ts: 3
		},
		{
			ts: 99999999
		}],
		[{
			ts: 33333333
		}],
	])
  time
  accounts{
    id
    number
    currency {
      __typename
      ...on NamedCurrency {
        name
      }
      ...on CodedCurrency {
        code
      }
    }
    status
    amount
    createdAt
    transactions{id
      amount
      status
      account{
        id
        number
        currency{
          __typename
        }
      }
      log {
          __typename
          ...on TransactionMessageLog {
            message
          }
          ...on TransactionCodeLog {
            code
          }
        }
      createdAt
    }
  }
}
```

##### CURL

```shell
curl --request POST \
  --url http://localhost:8080/ \
  --header 'Content-Type: application/json' \
  --header 'X-AUTH-ROLE: watcher' \
  --header 'X-AUTH-USERNAME: asdf' \
  --data '{"query":"query{\n  currentUser {\n    username\n    role\n  }\n  mod(input: {x: 11, y: 4})\n  sum(sumInput: {x: 2, y: 3})\n  echo(input: \"Hello\")\n  print(input: \"Hello\")\n\tdayTime(timestamps: [\n\t\t[{\n\t\t\tts: 3\n\t\t},\n\t\t{\n\t\t\tts: 99999999\n\t\t}],\n\t\t[{\n\t\t\tts: 33333333\n\t\t}],\n\t])\n  time\n  accounts{\n    id\n    number\n    currency {\n      __typename\n      ...on NamedCurrency {\n        name\n      }\n      ...on CodedCurrency {\n        code\n      }\n    }\n    status\n    amount\n    createdAt\n    transactions{id\n      amount\n      status\n      account{\n        id\n        number\n        currency{\n          __typename\n        }\n      }\n      log {\n          __typename\n          ...on TransactionMessageLog {\n            message\n          }\n          ...on TransactionCodeLog {\n            code\n          }\n        }\n      createdAt\n    }\n  }\n}"}'
```

## Symfony Bundle FlexibleGraphqlBundle

Command for generate TypeRegistry

```shell
php bin/console flexible_graphql:generate-type-registry
```

Run http server for handle GraphQL requests

```shell
php -S localhost:8080 FlexibleGraphqlBundle/index.php
```

## NoFramework

Command for generate TypeRegistry

```shell
php NoFramework/generate.php
```

Run http server for handle GraphQL requests

```shell
php -S localhost:8080 NoFramework/index.php
```

## Apollo Federation Integration

install node.js

Install dependency

```shell
cd ApolloFederation
npm install
```

Run Apollo Federation

```shell
cd ApolloFederation
node index
```