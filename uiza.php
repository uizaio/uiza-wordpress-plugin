<?php
require __DIR__ . "/vendor/autoload.php";
require_once "common.php";

/**
 * Uiza Plugin is the WordPress plugin for show video streaming, covert, upload video to S3.
 * Take this as a base plugin and modify as per your need.
 *
 * @package Uiza Plugin
 * @author Tritv
 * @license GPL-2.0+
 * @link https://uiza.io/
 * @copyright 2019 Uiza, LLC. All rights reserved.
 *
 *            @wordpress-plugin
 *            Plugin Name: Uiza Plugin
 *            Plugin URI: https://uiza.io/
 *            Description: Uiza Plugin is the WordPress plugin for show video streaming, covert, upload video to S3.
 *            Version: 1.0
 *            Author: Tritv
 *            Author URI: https://uiza.io/
 *            Text Domain: uiza
 *            Contributors: Tritv
 *            License: GPL-2.0+
 *            License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
wp_enqueue_style('bootstrap.min.css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
wp_enqueue_script('jquery-3.3.1.js', 'https://code.jquery.com/jquery-3.3.1.js');
wp_enqueue_script('aws-sdk-2.283.1.min.js', 'https://sdk.amazonaws.com/js/aws-sdk-2.283.1.min.js');

add_action("admin_menu", "uiza_add_menu");

add_action("admin_init", "uiza_settings");

// add_action('admin_menu', 'add_custom_link_into_uiza_menu');

// /**
//  * Append saved textfield value to each post
//  *
//  * @since 1.0
//  */
// add_filter('the_content', 'com_content');
