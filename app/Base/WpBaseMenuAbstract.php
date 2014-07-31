<?php

namespace AudioDharma\Base;

use AudioDharma\Base\WpApiWrapper as WP;

abstract class WpBaseMenuAbstract {

    protected
        $wp,
        $handler
    ;

   public
        $page_title,
        $menu_title,
        $capability,
        $menu_slug,
        $icon_url = '',
        $position = null,
        $parent_slug;

    public function __construct(WP $wp, MenuHandler $handler)
    {
        $this->wp = $wp;
        $this->handler = $handler;

        $this->wp->add_action('admin_menu', array($this, 'addMenu'));
        $this->addActions();
    }

    /*
     * This is where you would register any actions related
     * to the menu, enqueueing javascript or css, etc
     * Use "\Sketch\UriTrait" in any menu for easier access to public assets
     */
    protected function addActions(){}

}