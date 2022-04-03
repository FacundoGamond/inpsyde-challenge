<?php

/**
 * Plugin Name: Inpsyde Challenge
 * Description: Inpsyde challenge code.
 * Version: 1.0.0
 * Author: Facundo Gamond
 * Author URI: https://facundogamond.com.ar
 * Text Domain: inpsydechallenge
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

require_once dirname(__FILE__) . "/vendor/autoload.php";

use Facundogamond\InpsydeChallenge\RestApiUsers;
use Facundogamond\InpsydeChallenge\FrontendFeatures;

new RestApiUsers();
new FrontendFeatures();
