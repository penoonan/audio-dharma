<?php

namespace AudioDharma\Base;

interface TaxonomyInterface {

    public function addObjectType($object_type);
    public function add();
    public function metaboxCallback($post, $box);
    public function setMetabox(MetaboxInterface $metabox);
    public function getName();
} 