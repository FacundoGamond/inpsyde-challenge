# Inpsyde Challenge
The main idea of this plugin is that to return on the frontend a table of users from a [external api](https://jsonplaceholder.typicode.com/) but using Wordpress Custom Endpoint to do the job.

## Install
- Paste this repository folder into your `wp-contet/plugins` folder or clone it there.
- Run `composer install` in order to install required dependences.

## Usage
After install this plugin, the route `/inpsyde-challenge` must be available without save permalinks.

## Code Standards and Unit Testing
- Run `vendor/bin/phpcs --standard="Inpsyde" ./src/ ./inpsyde-challenge.php ./tests ./templates` in order to check code standards.
- Run `vendor/phpunit/phpunit/phpunit tests/` to execute unit tests.

## Features
This code example has features like:
- Composer Dependency injection:
    - [Inpsyde Code Standards](https://github.com/inpsyde/php-coding-standards)
    - [Brain Monkey](https://giuseppe-mazzapica.gitbook.io/brain-monkey/)
    - [PHP Unit](https://phpunit.de/)
- Composer PSR-4 autoload.
- Custom Endpoints with cache.
- NPM Dependency injection:
    - [Axios](https://axios-http.com/)
    - [Webpack](https://webpack.js.org/)

