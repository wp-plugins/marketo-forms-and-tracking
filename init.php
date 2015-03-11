<?php
/**
 * Marketo Forms and Tracking
 * 
 * Integrate Marketo with WordPress by prepopulating fields and providing wysiwyg shortcodes 
 * 
 * Plugin Name: Marketo Forms and Tracking
 * Description: Integrate Marketo with WordPress by providing wysiwyg shortcodes, prepopulating fields and running the munchkin.js script
 * Version: 1.0.2
 * Author: Hutchhouse
 * Author URI: http://www.hutchhouse.com
 * 
 * @package Marketo_FAT
 * @author Hutchhouse
 * @author Simon Holloway
 */

define('MARKETO_FAT_URL', plugins_url('' , __FILE__));
define('MARKETO_FAT_PATH', __DIR__);

require(__DIR__ . '/client.php');
require(__DIR__ . '/admin.php');
require(__DIR__ . '/helpers.php');
require(__DIR__ . '/hooks.php');
require(__DIR__ . '/shortcode.php');
require(__DIR__ . '/popout.php');
