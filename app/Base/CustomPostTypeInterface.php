<?php

namespace AudioDharma\Base;

use AudioDharma\Base\MetaboxInterface as Metabox;

interface CustomPostTypeInterface {
    public function register();
    public function addMetabox(Metabox $metabox);
    public function metaboxCallback($post);
} 