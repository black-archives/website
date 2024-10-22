#!/bin/env bash

# The purpose of this script is to spin up a local development environment for
# Wordpress website using Docker containers for the database, Wordpress, and
# phpMyAdmin. To get started, run the following command: `./entrypoint.sh start`

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
ROOT_DIR=$(realpath "${CURRENT_DIR}/..") # Move up one directory

## CONSTANTS ############################################

DOCKER_COMPOSE_NETWORK="wp_default"
DOCKER_MYSQL_CONTAINER_NAME="wp-mysql"
DOCKER_WORDPRESS_CONTAINER_NAME="wordpress"
DOCKER_PHPMYADMIN_CONTAINER_NAME="wp-mysql-dashboard"
DOCKER_WORDPRESS_PORT="8081"
DOCKER_PHPMYADMIN_PORT="8082"

ENV_FILE_PATH="${ROOT_DIR}/.env"

THEME_PATH="${ROOT_DIR}/src/"

DEV_DIR="${ROOT_DIR}/.dev"
DEV_MYSQL_DIR="${DEV_DIR}/database"
DEV_WORDPRESS_DIR="${DEV_DIR}/wordpress/"
DEV_DOCKER_COMPOSE_FILE="${DEV_DIR}/docker-compose.yaml"

## FUNCTIONS ############################################
usage() {
  echo -e "\nUsage: entrypoint.sh [command] [flags]"
  echo -e "\nCommands:"
  echo "  connect <HOST> <USER>     - Connect to a database by specifying the HOST (this is usually the contianer name for the mysql container) where the database is running and a valid USER to connect with."
  echo "  start [--dev]             - Start the application."
  echo "  stop [--clean]            - Stop the application. If the 'clean' flag is provided, the database and wordpress directories will be removed."
  echo -e "\nFlags:"
  echo "  --clean                   - Remove the database and wordpress directories."
  echo "  --dev                     - Run the application in development values."
}

util_log() {
  local message=$1
  local mode=$2

  if [[ "$mode" == "extra" ]]; then
    message="============ $message"
  fi

  echo "$message"
}

util_import_env() {
  ENV_FILE_PATH=$1
  
  if [ -f $ENV_FILE_PATH ]; then
    util_log "Importing environment variables from $ENV_FILE_PATH..." extra

    # export all lines in the .env file that are not comments
    for line in $(cat $ENV_FILE_PATH | grep -v '^#')
    do
      export $line
    done
  fi
}

create_docker_compose_file() {
  util_log "Creating docker-compose.yaml file..." extra
  echo "
    name: wp

    services:
      mysql:
        container_name: $DOCKER_MYSQL_CONTAINER_NAME
        image: mysql:9.0.1
        restart: always
        environment:
          MYSQL_DATABASE: $MYSQL_DATABASE_NAME
          MYSQL_ROOT_PASSWORD: $MYSQL_ROOT_PASSWORD
          MYSQL_USER: $MYSQL_USER
          MYSQL_PASSWORD: $MYSQL_PASSWORD
        networks:
          - default
        volumes:
          - $DEV_MYSQL_DIR:/var/lib/mysql

      phpmyadmin:
        depends_on:
          - mysql
        container_name: $DOCKER_PHPMYADMIN_CONTAINER_NAME
        image: phpmyadmin:5.2.1
        restart: always
        environment:
          PMA_HOST: $DOCKER_MYSQL_CONTAINER_NAME
        ports:
          - $DOCKER_PHPMYADMIN_PORT:80
        networks:
          - default

      wordpress:
        depends_on:
          - mysql
        container_name: $DOCKER_WORDPRESS_CONTAINER_NAME
        image: wordpress:6.6.1
        restart: always
        environment:
          WORDPRESS_DB_HOST: $DOCKER_MYSQL_CONTAINER_NAME
          WORDPRESS_DB_NAME: $MYSQL_DATABASE_NAME
          WORDPRESS_DB_USER: $MYSQL_USER
          WORDPRESS_DB_PASSWORD: $MYSQL_PASSWORD
        ports:
          - $DOCKER_WORDPRESS_PORT:80
        networks:
          - default
        volumes:
          - $THEME_PATH:/usr/src/wordpress/wp-content/themes/highwire
          - $THEME_PATH:/var/www/html/wp-content/themes/highwire
          - $DEV_WORDPRESS_DIR:/var/www/html

    networks:
      default:
  " > $DEV_DOCKER_COMPOSE_FILE
}

connect_to_mysql() {
  util_log "Connecting to database..." extra
  
  HOST=$1
  USER=$2

  if [ -z $HOST ]; then
    util_log "ERROR: Missing HOST"
    usage
    exit 1
  fi

  if [ -z $USER ]; then
    util_log "ERROR: Missing USER ($USER)"
    exit 1
  fi
  
  docker run -it --rm --network $DOCKER_COMPOSE_NETWORK mysql mysql -h $HOST -u $USER -p
}

setup_directories() {
  if [ ! -d $DEV_MYSQL_DIR ]; then
    util_log "Creating database directory..." extra
    mkdir -p $DEV_MYSQL_DIR
  else
    util_log "Database directory already exists..." extra
  fi

  if [ ! -d $DEV_WORDPRESS_DIR ]; then
    util_log "Creating wordpress directory..." extra
    mkdir -p $DEV_WORDPRESS_DIR
  else
    util_log "Wordpress directory already exists..." extra
  fi

  if [ ! -d $THEME_PATH ]; then
    util_log "Theme directory does not exist..." extra
    exit 1
  else
    cp -r $THEME_PATH $DEV_WORDPRESS_DIR/wp-content/themes/highwire
  fi
}

teardown_directories() {
  util_log "Removing database directory..." extra
  rm -rf $DEV_MYSQL_DIR

  util_log "Removing wordpress directory..." extra
  rm -rf $DEV_WORDPRESS_DIR
}

start_application() {
  FLAG=$1

  util_log "Starting the application..." extra

  # Import environment variables
  if [ "$FLAG" == "--dev" ]; then
    util_import_env ".env.example"
  elif [ ! -f $ENV_FILE_PATH ]; then
    util_log "ERROR: Missing .env file - please create one and try again (see the .env.example file for reference)."
    exit 1
  else
    util_import_env $ENV_FILE_PATH
  fi

  # Create the docker-compose.yaml file
  create_docker_compose_file

  # Check if the docker-compose.yaml file exists
  if [ ! -f "docker-compose.yaml" ]; then
    util_log "ERROR: Missing docker-compose.yaml file - please run 'entrypoint.sh compose' to create one."
    exit 1
  fi

  # Stop the application if it is already running
  if [ "$(docker ps -q -f name=$DOCKER_MYSQL_CONTAINER_NAME)" ] || [ "$(docker ps -q -f name=$DOCKER_WORDPRESS_CONTAINER_NAME)" ]; then
    util_log "Stopping the exiting application..." extra
    stop_application
  fi

  setup_directories
  #docker compose --file $DEV_DOCKER_COMPOSE_FILE up --remove-orphans
  docker compose --project-directory $DEV_DIR up --remove-orphans
}

stop_application() {
  FLAG=$1

  util_log "Stopping the application..." extra
  docker compose down
  
  if [ "$FLAG" == "--clean" ]; then
    util_log "Cleaning up directories..." extra
    teardown_directories
  fi
}

## MAIN #################################################

case $1 in
  compose)
    create_docker_compose_file
    ;;
  start)
    start_application $2
    ;;
  stop)
    stop_application $2
    ;;
  connect)
    connect_to_mysql $2 $3
    ;;
  *)
    usage
    ;;
esac