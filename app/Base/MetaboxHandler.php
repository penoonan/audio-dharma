<?php

namespace AudioDharma\Base;

interface MetaboxHandler {
    public function handle($args);
    public function save($post_id, $post);
}