const { ApolloGateway, IntrospectAndCompose, RemoteGraphQLDataSource} = require("@apollo/gateway");
const { ApolloServer } = require('apollo-server');

const gateway = new ApolloGateway({
    debug: true,
    supergraphSdl: new IntrospectAndCompose({
        subgraphs: [
            { name: 'flexible-graphql-bundle', url: 'http://flexible-graphql-bundle:8081/' },
            { name: 'no-framework', url: 'http://no-framework:8082/' },
        ],
        pollIntervalInMs: 10000,
    }),
    buildService({name, url}) {
        return new RemoteGraphQLDataSource({
            url,
            willSendRequest({request, context}) {
                if (context.headers) {
                    if (context.headers.hasOwnProperty('x-auth-username')) {
                        request.http.headers.set('x-auth-username', context.headers['x-auth-username']);
                    }
                    if (context.headers.hasOwnProperty('x-auth-role')) {
                        request.http.headers.set('x-auth-role', context.headers['x-auth-role']);
                    }
                }
            }
        });
    },
});

const server = new ApolloServer({
    gateway,
    subscriptions: false,
    context: ({req}) => ({
        headers: req.headers,
    })
});

server.listen({
    host: '0.0.0.0',
    port: 8080,
});
