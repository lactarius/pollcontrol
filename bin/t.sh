#!/bin/bash
vendor/bin/tester -s -p php -c /etc/php/7.0/cli/phpt.ini -j 1 $1
cat tests/tmp/*.log
