#!/bin/env bash

# The purpose of this script is to deploy the theme in the highwire directory
# (wp-content/themes/highwire) to a remote server in a specified location for
# easier deployments.

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
ROOT_DIR=$(realpath "${CURRENT_DIR}/..") # Move up one directory

## CONSTANTS ############################################

_SERVER_HOSTNAME=$1                         # hostname for server
_SERVER_USERNAME=$2                         # username for server
_SERVER_KEY_PATH=$3                         # path to the server key

SOURCE_THEME_PATH="${ROOT_DIR}/src/"
TARGET_THEME_PATH="/www/wp-content/themes/highwire/"

## MAIN ##################################################

# prompt for server hostname and username if not provided
if [ -z "${_SERVER_HOSTNAME}" ] || [ -z "${_SERVER_USERNAME}" ]; then
  read -p "Enter Server Hostname: " _SERVER_HOSTNAME
  read -p "Enter Server Username: " _SERVER_USERNAME
fi

# prompt for server key path if not provided
if [ -z "${_SERVER_KEY_PATH}" ]; then
  read -p "Enter Server Key Path (optional): " _SERVER_KEY_PATH
fi

echo "\n"
echo "Target Server: ${_SERVER_USERNAME}@${_SERVER_HOSTNAME}"
echo "Target Theme Path: ${TARGET_THEME_PATH}"
echo "Source Theme Path: ${SOURCE_THEME_PATH}"

# if the server key path is not provided, use the default ssh command
if [ -z "$_SERVER_KEY_PATH" ]; then
  rsync -avz --delete "${SOURCE_THEME_PATH}" "${_SERVER_USERNAME}@${_SERVER_HOSTNAME}:${TARGET_THEME_PATH}"
else
  rsync -avz --delete -e "ssh -i \"${_SERVER_KEY_PATH}\"" "${SOURCE_THEME_PATH}" "${_SERVER_USERNAME}@${_SERVER_HOSTNAME}:${TARGET_THEME_PATH}"
fi
