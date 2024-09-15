# Contributing

This repository sets up a basic Wordpress app with a MySQL database using Docker Compose. It comes with a bash script, `scripts/entrypoint.sh`, that can be used to start and stop the wordpress app, connect to the database, and create a fresh `docker-compose.yaml` file.

Shortcuts:

- [Getting Started](#getting-started) - setting up the app locally
- [Technical Context](#technical-context) - technical decisions and information
- [Security](#security) - securing the app
- [FAQ](#faq) - frequently asked questions

## Getting Started

This section will guide you through setting up the app locally (on your machine) using Docker Compose.

Pre-requisites:

- Install Docker

### Starting the app

> [!NOTE]
>
> Before starting the app, you will need to copy the `wp-content` directory from the remote server to the `.development/wordpress` directory. This directory contains the themes, plugins, and uploads for the Wordpress app that are needed to 'recreate' the website locally. In order to copy the `wp-content` directory from the remote server, see the [migrating remote data to local app](#migrating-remote-data-to-local-app) section.

To start the app locally, run the following command:

```bash
# start the app with default configurations
bash scripts/entrypoint.sh start --dev

# start the app with custom configurations
bash scripts/entrypoint.sh start

# connect to the MySQL database (databaseName: mysql, username: wp-user)
bash scripts/entrypoint.sh connect mysql wp-user
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
bash scripts/entrypoint.sh stop

# stop the app and remove the volumes
bash scripts/entrypoint.sh stop --clean
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

> [!NOTE]
>
> For routine development, it is recommended to copy the `wp-content` directory from the remote server to the `.development/wordpress` directory since it contains the themes, plugins, and uploads for the Wordpress app that are needed to 'recreate' the website locally. To speed this specific process up, you can use the [import.sh](./scripts/import.sh) script to copy the `wp-content` directory from the remote server to the `.development/wordpress` directory.

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

## Technical Context

Technical decisions and information made in the development of this Wordpress application for future reference.

### Themes

The Wordpress app uses a custom theme called Highwire by Sam Skogh, the original developer of the website. The theme is located in the [`/wordpress/wp-content/themes/highwire`](./wordpress/wp-content/themes/highwire/) directory.

### Plugins

> [!NOTE]
> The plugins with the `(BUG)` tag are not working as expected can cause issues with the website. I suspect that the plugins causing issues are all related to the `WPML Multilingual CMS` plugin which is a paid plugin that requires a license key to work properly and since local development does not have a license key, the plugin does not work as expected.

The Wordpress app comes with the following plugins, of which some are active and some are not (because they are not needed at the moment):

| Plugin Name                         | Active | Description                                                  |
| ----------------------------------- | ------ | ------------------------------------------------------------ |
| Advanced Custom Fields PRO          | Yes    | Custom fields for posts and pages                            |
| Advanced Custom Fields Multilingual | No     | Multilingual custom fields for posts and pages (needs WPML)  |
| All-in-One WP Migration             | No     | Migrate the website to another server                        |
| Campaign Monitor for WordPress      | Yes    | Campaign monitor for the website                             |
| Contact Form 7                      | Yes    | Contact form for the website                                 |
| Drag and Drop Multiple File Upload  | Yes    | Drag and drop file upload for the website                    |
| Duplicate Page                      | Yes    | Duplicate posts and pages                                    |
| Font Awesome                        | Yes    | Font Awesome icons for the website                           |
| Insert Headers and Footers          | Yes    | Insert headers and footers for the website                   |
| Under Construction                  | No     | Under construction page for the website                      |
| WPForms Lite                        | Yes    | Contact form for the website                                 |
| WPML Media                          | No     | Multilingual media for the website (needs WPML)              |
| WPML Multilingual CMS (**BUG**)     | No     | Multilingual CMS for the website                             |
| WPML String Translation             | No     | Multilingual string translation for the website (needs WPML) |
| Yoast SEO                           | Yes    | SEO for the website                                          |
| Yoast SEO Multilingual              | NO     | Multilingual SEO for the website (needs WPML)                |

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

## FAQ

### How do I export and import data from the Wordpress app?

> [!TIP]
> If you have issues importing data, try increasing the maximum upload size in the `.htaccess` file (see [this guide](#how-do-i-upload-more-than-2mb-of-data-to-the-wordpress-app)). If that doesn't work, try exporting and importing the data in smaller chunks.

You can export and import data from the Wordpress app using the [All-in-One WP Migration](https://wordpress.org/plugins/all-in-one-wp-migration/) plugin.

To export the data, follow these steps:

1. Install and activate the All-in-One WP Migration plugin
2. Go to `All-in-One WP Migration` > `Export` in the Wordpress admin dashboard
3. Click on `Export To` and select the desired location (e.g. `File`)
4. Click on advanced options to exclude/include certain data (e.g. media, themes, plugins) - *I try to export as much as possible*

To import the data, follow these steps:

1. Install and activate the All-in-One WP Migration plugin
2. Go to `All-in-One WP Migration` > `Import` in the Wordpress admin dashboard
3. Click on `Import From` and select the desired location (e.g. for `File`, upload the file that was exported with the `.wpress` extension)
4. Click on `Proceed` to start the import process
5. Once the import is complete, click on `Permalinks` to update the permalinks
6. Click on `Save Changes` to save the permalinks

### How do I upload more than 2MB of data to the Wordpress app?

Paste the following values into the `.htaccess` file to increase the maximum upload size:

```bash
php_value upload_max_filesize 1G
php_value post_max_size 1G
php_value memory_limit 256M
php_value max_execution_time 300
php_value max_input_time 300
```

TIP: You can change the values to your preference.

### How do I debug the Wordpress app?

To debug the Wordpress app, you can enable the `WP_DEBUG` mode in the `wp-config.php` file:

```php
define( 'WP_DEBUG', true );
```

### Why am I seeing a `404` error when I try to access a page that exists?

This might be due to the `.htaccess` file.

In the case of this specific app, it might be because the following lines of code are missing from the `# BEGIN WordPress` and `# END WordPress` block in the `.htaccess` file:

```xml
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
```

### How does the Events page work?

*The Events page is accessible via the `/events` URL and there is a pin icon in the wordpress admin page for 'Events' (and 'Exhibitions' even though it is not visible) and I can't find a php file that is responsible for the events page. So how does it work?*

The Events page is another kind of 'post' in Wordpress.

### What is the `do_shortcode` function in Wordpress and how does it work with the newsletter form? (Unsolved)
