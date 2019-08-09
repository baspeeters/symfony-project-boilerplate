#!/usr/bin/env bash

set -eox pipefail

if [[ ${COVERAGE} == 1 ]]
then
    ./vendor/bin/simple-phpunit --coverage-clover build/logs/clover.xml;
    ./vendor/bin/phpstan analyse -l 7 src tests
else
    ./vendor/bin/simple-phpunit
fi
