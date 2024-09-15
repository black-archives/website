#!/bin/env bash

# The purpose of this script is to deploy the theme in the highwire directory
# (wp-content/themes/highwire) to a remote server in a specified location for
# easier deployments.

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
ROOT_DIR="${CURRENT_DIR}/.." # Move up one directory

## CONSTANTS ############################################

_SERVER_HOSTNAME=$1                         # hostname for server
_SERVER_USERNAME=$2                         # username for server
_SERVER_KEY_PATH=$3                         # path to the server key
_CI_MODE=$4                                 # if "true", then don't check for strict host key checking

SOURCE_THEME_PATH="${ROOT_DIR}/src/*"
TARGET_THEME_PATH="/www/wp-content/themes/highwire/"

## MAIN ##################################################

if [ -z "${_SERVER_HOSTNAME}" ] || [ -z "${_SERVER_USERNAME}" ]; then
  read -p "Enter Server Hostname: " _SERVER_HOSTNAME
  read -p "Enter Server Username: " _SERVER_USERNAME
fi

if [ -z "${_SERVER_KEY_PATH}" ]; then
  read -p "Enter Server Key Path (optional): " _SERVER_KEY_PATH
fi

echo "Deploying theme to ${_SERVER_HOSTNAME}..."

if [ -z "$_SERVER_KEY_PATH" ]; then
  scp -r ${SOURCE_THEME_PATH} ${_SERVER_USERNAME}@${_SERVER_HOSTNAME}:${TARGET_THEME_PATH}
else
  if [[ "$_CI_MODE" = "true" || "$_CI_MODE" = "TRUE" || "$_CI_MODE" = "1" ]]; then
    scp -o StrictHostKeyChecking=no -i ${_SERVER_KEY_PATH} -r ${SOURCE_THEME_PATH} ${_SERVER_USERNAME}@${_SERVER_HOSTNAME}:${TARGET_THEME_PATH}
  else
    scp -i ${_SERVER_KEY_PATH} -r ${SOURCE_THEME_PATH} ${_SERVER_USERNAME}@${_SERVER_HOSTNAME}:${TARGET_THEME_PATH}
  fi
fi
