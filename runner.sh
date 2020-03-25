#!/bin/bash
php -f api.php "$1" > /dev/null 2>&1 &
