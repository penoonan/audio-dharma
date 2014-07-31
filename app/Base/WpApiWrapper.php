<?php

namespace AudioDharma\Base;

/**
 * This class exists to provide a wrapper around wordpress functions
 * so that applications built for Wordpress may be easily unit tested.
 * This makes Wordpress itself a mockable dependency.
 *
 * Class WpApiWrapper
 * @package Sketch
 */
class WpApiWrapper {

    public function wp_handle_upload(&$file, $overrides = false, $time = null)
    {
        return wp_handle_upload($file, $overrides, $time);
    }

    public function __call($method, $arguments)
    {
        //call_user_func($method, $arguments);
        return call_user_func_array($method, $arguments);
    }

} 