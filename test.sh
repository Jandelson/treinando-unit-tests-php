#!/bin/sh

docker build . -t app
docker run --name test  app vendor/bin/phpunit --whitelist ./src/Service --coverage-text --colors ./tests
docker container rm test