#syntax=docker/dockerfile:1.4
# Base stage for dev and build
FROM node:18-alpine as builder_base

# Check https://github.com/nodejs/docker-node/tree/b4117f9333da4138b03a546ec926ef50a31506c3#nodealpine to understand why libc6-compat might be needed.
RUN apk add --no-cache libc6-compat

RUN apk add --no-cache bash

WORKDIR /srv/app

# Deps stage, preserve dependencies in cache as long as the lockfile isn't changed
FROM builder_base AS deps

COPY --link package.json ./
RUN npm install


# Development image
FROM deps as dev
WORKDIR /srv/app

EXPOSE 3000
ENV PORT 3000

CMD ["sh", "-c", "npm install; npm run dev"]

FROM builder_base AS builder
COPY --link . .
COPY --from=deps --link /srv/app/node_modules ./node_modules
RUN npm run build





# Production image, copy all the files and run next
FROM node:18-alpine AS prod
WORKDIR /srv/app

ENV NODE_ENV production
# Uncomment the following line in case you want to disable telemetry during runtime.
# ENV NEXT_TELEMETRY_DISABLED 1

RUN addgroup --system --gid 1001 nodejs
RUN adduser --system --uid 1001 vuejs

COPY --from=builder --link /srv/app/public ./public

# Automatically leverage output traces to reduce image size
# https://vuejs.org/docs/advanced-features/output-file-tracing
COPY --from=builder --link --chown=vuejs:nodejs /srv/app/.vue/standalone ./
COPY --from=builder --link --chown=vuejs:nodejs /srv/app/.vue/static ./.vue/static

USER vuejs

EXPOSE 3000

ENV PORT 3000

CMD ["node", "server.js"]
