#!/bin/env bash

# The purpose of this script is to import the wp-content directory from a remote
# server to the local development environment. This is useful for syncing the
# local development environment with the production environment.
#
# NOTE: This script might take a while to run depending on the size of the target
# wp-content directory. 

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
ROOT_DIR=$(realpath "${CURRENT_DIR}/..") # Move up one directory

## CONSTANTS ############################################

SOURCE_PATH="/www/wp-content/"
TARGET_PATH="${ROOT_DIR}/.dev/wordpress/wp-content/"

## MAIN ##################################################

read -p "Enter Server Hostname: " SERVER_HOSTNAME
read -p "Enter Server Username: " SERVER_USERNAME

echo "Importing content from $SERVER_HOSTNAME to $TARGET_PATH..."
scp -r $SERVER_USERNAME@$SERVER_HOSTNAME:$SOURCE_PATH $TARGET_PATH