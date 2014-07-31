<?php

namespace AudioDharma;

use AudioDharma\Base\BaseTaxonomy;

class Concepts extends BaseTaxonomy {
    protected
        $taxonomy = "dharma_talk_concepts",
        $labels = array(
            'name' => 'Concepts',
            'singular_name' => 'Concept'
        ),
        $args = array(
            'hierarchical' => true
        )
    ;
} 