<?php
/**
 * @package Audio_Dharma
 * @version 0.1
 */
/*
Plugin Name: Audio Dharma
Description: Upload dharma talks, select topics and authors as tags and taxonomies. This plugin was created for Common Ground Meditation Center in Minneapolis, MN.
Author: Common Ground Meditation Center
Developer: Patrick Noonan
Version: 0.1
Author URI: http://www.commongroundmeditation.org
License: Copyright Common Ground Meditation Center
*/

use AudioDharma\Concepts;
use AudioDharma\DharmaTalk;
use AudioDharma\DharmaTalkMetabox;
use AudioDharma\DharmaTalkMetaboxHandler;
use AudioDharma\Programs;
use AudioDharma\Repo\AudioFile;
use AudioDharma\Repo\Teacher as TeacherRepo;
use AudioDharma\SettingsMenu;
use AudioDharma\SettingsMenuHandler;
use AudioDharma\Teacher;

ini_set('display_errors', -1); error_reporting(E_ALL);
$app = require_once(__DIR__ . '/bootstrap.php');

$dt_metabox = new DharmaTalkMetabox(
    $app['wp'],
    new DharmaTalkMetaboxHandler(
        $app['plates'],
        new TeacherRepo($app['wp']),
        new AudioFile($app['wp'], $app['id3']),
        $app['request']
    )
);

$teacher = new Teacher($app['wp']);
$concepts = new Concepts($app['wp']);
$programs = new Programs($app['wp']);

$talk = new DharmaTalk($app['wp']);
$talk->addMetabox($dt_metabox);
$talk->addTaxonomy($concepts);
$talk->addTaxonomy($programs);

$settings_menu = new SettingsMenu(
    $app['wp'],
    new SettingsMenuHandler(
        $app['plates'],
        $app['wp'],
        $app['request']
    )
);

function update_edit_form() {
    global $post;
    if ($post->post_type === 'dharma_talk') {
        echo ' enctype="multipart/form-data"';
    }
}
add_action('post_edit_form_tag', 'update_edit_form');