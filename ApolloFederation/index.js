const { ApolloGateway, IntrospectAndCompose, RemoteGraphQLDataSource} = require("@apollo/gateway");
const { ApolloServer } = require('@apollo/server');
const { startStandaloneServer } = require('@apollo/server/standalone')
const fs = require('fs');

const gateway = new ApolloGateway({
    debug: true,
    supergraphSdl: fs.readFileSync("/app/supergraph.graphql").toString(),
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

async function startApolloServer() {
    const server = new ApolloServer({
        gateway,
        debug: true,
        // Subscriptions are unsupported but planned for a future Gateway version.
        subscriptions: false,
    });
    const { url } = await startStandaloneServer(server, {
        context: ({req}) => ({
            headers: req.headers,
        }),
        listen: { port: 8888 },
    });

    console.log(`🚀  Server ready at ${url}`);
}

startApolloServer();
