#!/bin/env bash

# The purpose of this script is to deploy the theme in the highwire directory
# (wp-content/themes/highwire) to a remote server in a specified location for
# easier deployments.

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
CURRENT_DIR="${CURRENT_DIR}/.." # Move up one directory

## CONSTANTS ############################################

SERVER_HOSTNAME=$1
SERVER_USERNAME=$2
SERVER_KEY_PATH=$3

SOURCE_THEME_PATH="${CURRENT_DIR}/wordpress/wp-content/themes/highwire/*"
TARGET_THEME_PATH="/www/wp-content/themes/highwire/"

## MAIN ##################################################

if [ -z "$SERVER_HOSTNAME" ] || [ -z "$SERVER_USERNAME" ]; then
  read -p "Enter Server Hostname: " SERVER_HOSTNAME
  read -p "Enter Server Username: " SERVER_USERNAME
fi

if [ -z "$SERVER_KEY_PATH" ]; then
  read -p "Enter Server Key Path (optional): " SERVER_KEY_PATH
fi


echo "Deploying theme to $SERVER_HOSTNAME..."

if [ -z "$SERVER_KEY_PATH" ]; then
  scp -r $SOURCE_THEME_PATH $SERVER_USERNAME@$SERVER_HOSTNAME:$TARGET_THEME_PATH
else
  scp -i $SERVER_KEY_PATH -r $SOURCE_THEME_PATH $SERVER_USERNAME@$SERVER_HOSTNAME:$TARGET_THEME_PATH
fi
