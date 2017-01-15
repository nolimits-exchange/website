#!/usr/bin/env bash

echo -e "\033[32mExposing the host IP as \$DOCKERHOST \033[0m"

# This is so we can reference the host via the host "dockermachine" and have a working xdebug.
export DOCKERHOST=$(ifconfig | grep -E "([0-9]{1,3}\.){3}[0-9]{1,3}" | grep -v 127.0.0.1 | awk '{ print $2 }' | cut -f2 -d: | head -n1)

# Add a friendly reminder to restart our containers.
echo -e "\033[32mDone!\033[0m Don't forget to docker-compose restart!"
