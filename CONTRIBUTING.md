# Contributing

This repository sets up a basic Wordpress app with a MySQL database using Docker Compose. It comes with a bash script, `entrypoint.sh`, that can be used to start and stop the wordpress app, connect to the database, and create a fresh `docker-compose.yaml` file.

Shortcuts:

- [Getting Started Locally](#getting-started-locally)
- [Security](#security)

## Getting Started Locally

This section will guide you through setting up the app locally (on your machine) using Docker Compose.

Pre-requisites:

- Install Docker

### Starting the app

To start the app locally, run the following command:

```bash
# start the app with default configurations
bash entrypoint.sh start --dev

# start the app with custom configurations
bash entrypoint.sh start

# connect to the MySQL database (databaseName: mysql, username: wp-user)
bash entrypoint.sh connect mysql wp-user
```

The `start` command will perform the following steps:

1. creates a `/database` and `/wordpress` directory
2. creates a `docker-compose.yaml` file with provided configurations
3. import environment variables from the `.env` file (if the file doesn't exist, it will use default configurations)
4. runs `docker compose up` to start the MySQL database, phpMyAdmin, and Wordpress app

### Stopping the app

To stop the app, run the following command:

```bash
# stop the app
bash entrypoint.sh stop

# stop the app and remove the volumes
bash entrypoint.sh stop --clean
```

### Default Configurations

> [!WARNING]
> The default values below are for testing/development purposes only and should not be used in production. Please see the [security section](#security) for more information on how to secure the app.

The MySQL database and Wordpress app are set up with the following configurations (if the `--dev` flag is set):

| Key                    | Value     | Description                                                   |
| ---------------------- | --------- | ------------------------------------------------------------- |
| MySQL name             | `wp`      | The database name for the MySQL database                      |
| MySQL root username    | `root`    | The root username for the MySQL database                      |
| MySQL root password    | `root`    | The root password for the MySQL database                      |
| MySQL regular username | `wp-user` | The regular username for the MySQL database and Wordpress app |
| MySQL regular password | `wp-pass` | The regular password for the MySQL database and Wordpress app |

### Migrating remote data to local app

This essentially involves exporting the remote wordpress application using the [All-in-One WP Migration](https://wordpress.org/plugins/all-in-one-wp-migration/) plugin and importing it into the local app.

1. Export the remote Wordpress app using the All-in-One WP Migration plugin
2. Download the exported file
3. Import the file into the local Wordpress app using the All-in-One WP Migration plugin

The exported file may be larger than the maximum upload size (usually 2MB) for Wordpress. If this is the case, you can increase the maximum upload size by pasting the following values into the `.htaccess` file:

```bash
# this will increase the maximum upload size to 128MB (you can change the values to your preference)
php_value upload_max_filesize 128M
php_value post_max_size 128M
php_value memory_limit 256M
php_value max_execution_time 300
php_value max_input_time 300
```

## Deployment

This section will guide you through deploying the app to a server using Docker Compose.

```md
To Be Announced
```

## Security

The default values listed in the [default configurations](#default-configurations) for the MySQL database and Wordpress app are very common and should not be used in a production environment where real information is stored and accessed publically because they are easily guessable which exposes your website to security vulnerabilities.

Instead, it is recommended to create an `.env` file with secure values for the MySQL database and Wordpress app.

### Create an Env File

- create an env file file (see [.env.example](.env.example) for an example)
- update the `MYSQL_ROOT_PASSWORD`, `MYSQL_USER`, and `MYSQL_PASSWORD` values in the `.env` file with secure values
- restart the app

Create an `.env` file with the following content:

```bash
# .env
MYSQL_DATABASE=wp
MYSQL_ROOT_PASSWORD=secure-root-password
MYSQL_USER=wp-user
MYSQL_PASSWORD=secure-user-password
```

### Strong Passwords

A strong password should be easy to remember but hard to guess. Below are some recommendations:

- use at least 8 characters
- use phrases that are easy to remember but hard to guess (i.e. `ilovetoeathotdogs` instead of `h0td0gs@ndk3tchup`)
- use a mix of uppercase and lowercase letters, numbers, and special characters, if you can
- avoid using common words, phrases, or patterns in your passwords that can be inferred from your personal information (e.g. your name, birthdate, birth year etc.)
