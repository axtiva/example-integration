FROM node:16-bullseye-slim

ENV VERSION v0.13.0
ENV URL https://github.com/apollographql/rover/releases/download

RUN apt-get update \
    && apt-get install --no-install-recommends -y curl apt-transport-https ca-certificates  \
    && curl -sSfL ${URL}/${VERSION}/rover-${VERSION}-x86_64-unknown-linux-gnu.tar.gz -o /tmp/rover-${VERSION}.tar.gz \
    && tar xf /tmp/rover-${VERSION}.tar.gz --strip-components 1 -C /tmp/ \
    && mv /tmp/rover /usr/local/bin

ENV APOLLO_ELV2_LICENSE=accept

# /usr/local/bin/rover

