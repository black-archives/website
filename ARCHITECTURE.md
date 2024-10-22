# Architecture

This document contains the technical decisions and information made in the development of this Wordpress application for future reference.

Wordpress is made up of pages, posts and plugins. The pages and posts are created by the website owner/administrator and the plugins are used to extend the functionality of the website. This repository contains the theme of the website which extends the visual appearance and behavior of the website using PHP, HTML, CSS, JavaScript and the Advanced Custom Fields plugin.

## Application

### Plugins

Plugins are reusable pieces of code that can be added to the Wordpress app to extend its functionality. The most important plugin used by this Wordpress app is the `Advanced Custom Fields PRO` and `WPML Multilingual CMS` plugins.

The [Advanced Custom Fields PRO](https://www.advancedcustomfields.com/) plugin is used to create custom fields for posts and pages. You can define fields (i.e. lists with text and urls for a list of buttons) that a page/post author can fill via the Wordpress admin panel. The fields are then displayed programmatically in the theme files (i.e. see [`/src/page-map.php`](./src/page-map.php)).

The [WPML Multilingual CMS](https://wpml.org/) plugin is used to create a multilingual website. The plugin allows the website owner/administrator to create translations for pages and posts. The plugin also allows the website owner/administrator to create translations for custom fields created by the `Advanced Custom Fields PRO` plugin. The plugin is used to create translations for the website in English and Swedish.

> [!NOTE]
> The plugins with the `(BUG)` tag are not working as expected can cause issues with the website. I suspect that the plugins causing issues are all related to the `WPML Multilingual CMS` plugin which is a paid plugin that requires a license key to work properly and since local development does not have a license key, the plugin does not work as expected.

The Wordpress app comes with the following plugins, of which some are active and some are not (because they are not needed at the moment):

| Plugin Name                         | Active | Description                                                  |
| ----------------------------------- | ------ | ------------------------------------------------------------ |
| Advanced Custom Fields Multilingual | ✅      | Multilingual custom fields for posts and pages (needs WPML)  |
| Advanced Custom Fields PRO          | ✅      | Custom fields for posts and pages                            |
| All-in-One WP Migration             | ❌      | Migrate the website to another server                        |
| Campaign Monitor for WordPress      | ✅      | Campaign monitor for the website                             |
| Contact Form 7                      | ✅      | Contact form for the website                                 |
| Drag and Drop Multiple File Upload  | ✅      | Drag and drop file upload for the website                    |
| Duplicate Page                      | ✅      | Duplicate posts and pages                                    |
| Font Awesome                        | ✅      | Font Awesome icons for the website                           |
| WPCode Lite                         | ✅      | Code snippets for the website                                |
| WPForms Lite                        | ✅      | Contact form for the website                                 |
| WPML Media Translation              | ❌      | Multilingual media for the website (needs WPML)              |
| (**BUG**) WPML Multilingual CMS     | ❌      | Multilingual CMS for the website                             |
| WPML String Translation             | ❌      | Multilingual string translation for the website (needs WPML) |
| Yoast SEO                           | ✅      | SEO for the website                                          |

### Themes

The Wordpress app uses a custom theme called Highwire by Sam Skogh, the original developer of this website. The theme is located in the [`/src`](./src/) directory.

The theme uses the `Advanced Custom Fields PRO` plugin to create extend the functionality of the theme which you can see in php files with the `get_field()` and `get_sub_field()` functions, for example in the [`/src/page-map.php`](./src/page-map.php) file.

The `/src` directory contains the following files and directories:

- `assets/`: Contains the CSS, JavaScript and images for the theme
- `inc/`: Contains the PHP files for the theme
- `languages/`: Contains the language files for the theme
- `scripts/`: Contains the scripts for the theme

## Deployment

This repository only contains the theme of the Wordpress website. Whenever changes are pushed to the `main` branch, we run a github workflow automation, [`.github/workflows/ci.yaml`](./.github/workflows/ci.yaml), which copies the theme files in the `src` directory to a remote file server using `scp`.

The remote file server is hosted on [One.com](https://www.one.com/), a web hosting service, which is used to store the entire Wordpress application (i.e. config files, plugins, themes, etc.) and the Mysql database.
