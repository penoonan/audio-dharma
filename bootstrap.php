<?php

use AudioDharma\Base\Request;
use AudioDharma\Base\TemplateHelpers;
use AudioDharma\Base\WpApiWrapper;
use AudioDharma\Service\DharmaID3;
use AudioDharma\Service\Id3Factory;
use League\Plates\Engine;
use League\Plates\Template;
use Pimple\Container;

require_once __DIR__ . "/vendor/autoload.php";

$app = new Container();

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

$app['request'] = function() {
    return Request::createFromGlobals();
};

return $app;