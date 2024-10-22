# Contributing

This repository implements a Wordpress Application. Locally, it comes with a bash script, `scripts/entrypoint.sh`, that sets spins up a MYSQL, PHPAdmin and Wordpress container using Docker Compose.

Shortcuts:

- [Getting Started](#getting-started) - setting up the app locally
- [Security](#security) - securing the app
- [FAQ](#faq) - frequently asked questions

## Getting Started

This section will guide you through setting up the app locally (on your machine) using Docker Compose.

Pre-requisites:

- Install [Docker](https://docs.docker.com/get-started/get-docker/)

> [!NOTE]
> To simulate the real website locally, you'll need to import some data (i.e. database, plugins and media files) from the remote WP application. For more information on how to do this, see the *"[How do I export and import data from the Wordpress app](#how-do-i-export-and-import-data-from-the-wordpress-app)"* section.

To start the app locally, run the following command and open the browser to `http://localhost:8081/`:

```bash
# start the app with default configurations
bash scripts/entrypoint.sh start --dev

# start the app with custom configurations
bash scripts/entrypoint.sh start
```

The `start` command will perform the following steps:

1. creates a `.dev/database` and `.dev/wordpress` directory
2. creates a `.dev/docker-compose.yaml` file with provided configurations
3. import environment variables from the `.env` file (if the file doesn't exist, it will use default configurations)
4. runs `docker compose up` to start the MySQL database, phpMyAdmin, and Wordpress app

To stop the app, run `ctrl + c` in the terminal.

### Default Configurations

> [!WARNING]
> The default values below are credentials for testing/development purposes only and should not be used in production. Please see the [security section](#security) for more information on how to secure the app.

The MySQL database and Wordpress app are set up with the following configurations (if the `--dev` flag is set):

| Key                    | Value     | Description                                                   |
| ---------------------- | --------- | ------------------------------------------------------------- |
| MySQL name             | `wp`      | The database name for the MySQL database                      |
| MySQL root username    | `root`    | The root username for the MySQL database                      |
| MySQL root password    | `root`    | The root password for the MySQL database                      |
| MySQL regular username | `wp-user` | The regular username for the MySQL database and Wordpress app |
| MySQL regular password | `wp-pass` | The regular password for the MySQL database and Wordpress app |

## Security

Wordpress uses a MySQL database to store data (i.e. posts, pages, settings). You need to configure the wordpress app, in the `wp-config.php` file, to connect to the MySQL database using the database credentials (i.e. database name, username, password).

The default configurations listed in the [default configurations](#default-configurations) for the MySQL database and Wordpress app are very common and should not be used in a production environment where real information is stored and accessed publically because they are easily guessable which means that unauthorized hackers can easily access your website.

Instead, it is recommended to:

1. never check your `wp-config.php` file into version control (i.e. git)
2. use environment variables (i.e. `.env` file) to store and inject credentials into the Wordpress app
3. create secure passwords for the MySQL database and Wordpress app

### Using Environment Variables

Setting up environment variables:

1. create an env file at the root of the project (see [.env.example](.env.example) for an example)
2. update the `MYSQL_ROOT_PASSWORD`, `MYSQL_USER`, and `MYSQL_PASSWORD` values in the `.env` file with secure values
3. restart the app

### Strong Passwords

A strong password should be easy to remember but hard to guess. Below are some recommendations:

- use phrases that are easy to remember but hard to guess (i.e. `ilovetoeathotdogs!!!` instead of `h0td0gs@ndk3tchup`)
- use atleast two types of characters (i.e. uppercase and lowercase letters, numbers, special characters)
- avoid themes or patterns that can be inferred from your personal information (i.e. your name, birthdate, birth year etc.)

## FAQ

### How do I export and import data from the Wordpress app?

If you run the app locally, you will get a fresh Wordpress app with no data - it may have the theme but it will not have any posts, pages, media files, etc. To simulate the real website locally, you will need to export some data from the remote server and import it into the local app.

Exporting data (media files, plugins and databases) from the remote website:

1. Go to the remote Wordpress app
2. Install and activate the [All-in-One WP Migration](https://wordpress.org/plugins/all-in-one-wp-migration/) plugin
3. Go to `All-in-One WP Migration` > `Export` in the Wordpress admin dashboard
4. Click on `Advanced Options` and check all checkboxes except `Do not export media library`
5. Click on `Export To` and select the desired location (e.g. `File`)
6. Click on `Export` to start the export process
7. Repeat steps 4-6 for `Do not export must-use plugins`, `Do not export plugins` and `Do not export database`

> [!NOTE]
> If you cannot upload a file larger than 2MB, see [how to increase the upload size](#how-do-i-upload-more-than-2mb-of-data-to-the-wordpress-app).

Importing data into the local app:

1. Install and activate the [All-in-One WP Migration](https://wordpress.org/plugins/all-in-one-wp-migration/) plugin
2. Go to `All-in-One WP Migration` > `Import` in the Wordpress admin dashboard
3. Click on `Import From` and select the downloaded file for the `Do not export media library` export
4. Click on `Proceed` to start the import process
5. Repeat for the `Do not export must-use plugins`, `Do not export plugins` and `Do not export database` exports

### How do I upload more than 2MB of data to the Wordpress app?

> [!TIP]
> You can increase the maximum upload size by updating the values in the example snippet below.

Paste the following values into the `.dev/wordpress/.htaccess` file to increase the maximum upload size:

```bash
php_value upload_max_filesize 2G
php_value post_max_size 2G
php_value memory_limit 300M
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
