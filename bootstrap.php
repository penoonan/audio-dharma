<?php

use Pimple\Container;
use League\Plates\Engine;
use League\Plates\Template;
use AudioDharma\Base\Request;
use AudioDharma\Base\TemplateHelpers;
use AudioDharma\Base\WpApiWrapper;
use AudioDharma\Service\DharmaID3;
use AudioDharma\Service\Id3Factory;
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

require_once __DIR__ . "/vendor/autoload.php";

// Configure the DI container!
$app = new Container();

$app['request'] = function() {
    return Request::createFromGlobals();
};

$app['wp'] = function() { return new WpApiWrapper(); };

$app['plates'] = function($app) {
    $engine = new Engine(__DIR__.'/app/views');
    $engine->loadExtension(new TemplateHelpers($app['wp']));
    $view_folders = glob( __DIR__.'/app/views' . '/*' , GLOB_ONLYDIR );
    foreach($view_folders as $folder) {
        $engine->addFolder(basename($folder), $folder);
    }
    return new Template($engine);
};

$app['id3'] = function($app) {
    $settings = $app['wp']->get_option('cgmcdt_mp3_tag_setttings');

    if (!$settings) {
        $settings = require_once 'app/Config/default_tag_settings.php';
        $app['wp']->update_option('cgmcdt_mp3_tag_setttings', $settings);
    }

    $id3 = new DharmaID3(new Id3Factory);
    $id3->configureTags($settings);
    return $id3;
};



// Instantiate all the metaboxes and post types and whatnot!

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

return $app;