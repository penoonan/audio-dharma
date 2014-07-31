<?php

namespace AudioDharma\Base;

interface MetaboxInterface {
    public function add();
    public function manuallyAddAction();
    public function setPostType($post_type);
    public function dispatch($post, $meta_box);
    public function save($post_id);


}