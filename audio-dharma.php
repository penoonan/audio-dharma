<?php
/**
 * @package Audio_Dharma
 * @version 0.1
 */
/*
Plugin Name: Audio Dharma
Description: Upload dharma talks, select topics and authors as tags and taxonomies. This plugin was created for Common Ground Meditation Center in Minneapolis, MN. Requires PHP version 5.3.2 or higher.
Author: Common Ground Meditation Center
Developer: Patrick Noonan
Version: 0.1
Author URI: http://www.commongroundmeditation.org
License: Copyright Common Ground Meditation Center
*/

if (version_compare(PHP_VERSION, '5.3.2', '<')) {
    exit(sprintf('The Audio Dharma plugin requires PHP 5.3.2 or higher. Your PHP version is %s. Contact your server administrator or host provider to upgrade your PHP version.',PHP_VERSION));
} else {
    require __DIR__ . '/bootstrap.php';
}

