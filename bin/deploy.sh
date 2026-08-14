#!/usr/bin/env bash
# Deploy script for Ploi. Point the site's deploy script at:
#
#     cd /home/ploi/example.fi && bash bin/deploy.sh
#
# Ploi restarts php-fpm itself afterwards. Content lives in content/ on the
# server and is not in git — nothing here touches it.
set -euo pipefail

git pull origin main

composer install --no-dev --no-interaction --optimize-autoloader

npm ci
npm run build

# The page cache holds rendered HTML pointing at the previous asset hashes.
rm -rf storage/cache/*
