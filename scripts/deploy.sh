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
_CI_MODE=$4                                 # if "true", then don't check for strict host key checking

SOURCE_THEME_PATH="${ROOT_DIR}/src/*"
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

echo "Deploying theme to ${_SERVER_HOSTNAME}..."

# if the server key path is not provided, use the default ssh command
if [ -z "$_SERVER_KEY_PATH" ]; then
  ssh ${_SERVER_USERNAME}@${_SERVER_HOSTNAME} "rm -rf ${TARGET_THEME_PATH}/*"
  scp -r ${SOURCE_THEME_PATH} ${_SERVER_USERNAME}@${_SERVER_HOSTNAME}:${TARGET_THEME_PATH}
else

  # if the CI mode is enabled, then don't check for strict host key checking
  if [[ "$_CI_MODE" = "true" || "$_CI_MODE" = "TRUE" || "$_CI_MODE" = "1" ]]; then
    ssh -o StrictHostKeyChecking=no -i ${_SERVER_KEY_PATH} ${_SERVER_USERNAME}@${_SERVER_HOSTNAME} "rm -rf ${TARGET_THEME_PATH}/*"
    scp -o StrictHostKeyChecking=no -i ${_SERVER_KEY_PATH} -r ${SOURCE_THEME_PATH} ${_SERVER_USERNAME}@${_SERVER_HOSTNAME}:${TARGET_THEME_PATH}

  # otherwise, use the custom key path
  else
    ssh -i ${_SERVER_KEY_PATH} ${_SERVER_USERNAME}@${_SERVER_HOSTNAME} "rm -rf ${TARGET_THEME_PATH}/*"
    scp -i ${_SERVER_KEY_PATH} -r ${SOURCE_THEME_PATH} ${_SERVER_USERNAME}@${_SERVER_HOSTNAME}:${TARGET_THEME_PATH}
  fi
fi
