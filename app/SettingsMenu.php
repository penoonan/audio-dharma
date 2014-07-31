<?php

namespace AudioDharma;

use AudioDharma\Base\WpSubmenuAbstract;

class SettingsMenu extends WpSubmenuAbstract {

    public
        $parent_slug = "edit.php?post_type=dharma_talk",
        $page_title = 'Settings',
        $menu_title = "Mp3 Metadata",
        $menu_slug  = "cgmcdt_settings"
    ;

}