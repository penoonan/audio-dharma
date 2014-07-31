##Audio Dharma

Audio Dharma is a Wordpress plugin tasked with two main features:

 * Uploading mp3s of dharma talks, and associating them to the teachers who gave them
 * Editing the mp3 metadata upon upload to include all the correct information about genre, copyright, etc.

The purpose is to ease the process of taking a raw audio recording of a dharma talk and getting it up onto the web.

This plugin was created for the [Common Ground Meditation Center](http://commongroundmeditation.org/).

##Installation

Note that this project is still in development. To install, download this repository zip file, unzip it, rename the folder to "audio-dharma", and upload it to your site's plugin directory.

##Developer Notes

It's all wired together using Pimple and Composer autoloading. Learn more about the design philosophy by reading the docs from [Sketch](https://github.com/sketchwp/app). It's not 100% the same, but it does copy over a lot of code from that project, especially the code you'll find in `app/Base`.

There is one **significant gotcha:** MP3 Metadata edits are made using the Zend PHP Reader library, specifically the "id3v2" class. This library is from the pre-Composer days and it is threaded throughout with `require_once` statements. I'm not sure if it's missing a particular Zend autoloader or what, but those require paths were all inaccurate, making for a lot of fatal errors and a wholly unusable library.

Fortunately for us, the good people at Zend are very consistent - they always use `require_once` and they always have it alone on its own line. This created the opportunity for a terrible, terrible hack: using search & replace to put `//` at the beginning of all the `require_once` lines, thus commenting them out.

This should be okay, since the library is not listed as a required dependency in the project's `composer.json` (it's not even on packagist - I just dropped it into the vendor dir and used an autoload classmap) and is unlikely to ever need updating. However, if you ever *do* need to update it, here is the command to reproduce the aforementioned hack, since those changes will have been overwritten upon the update:

    cd path/to/audio-dharma/vendor/php-reader/library/Zend
    find . -type f -print0 | xargs -0 sed -i '' 's/require_once/\/\/require_once/g'

Hopefully that still works post-update. Due to the risk that it might not, it's best to avoid updating that library unless you're updating to a version that is compatible with Composer.

Beyond that, everything's pretty straightforward! Could definitely use some unit tests.