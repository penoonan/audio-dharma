<?php

namespace AudioDharma;

use AudioDharma\Base\BaseCustomPostType;

class DharmaTalk extends BaseCustomPostType {

    protected
        $post_type = 'dharma_talk',
        $args = array(
            'show_ui' => true,
            'show_in_menu' => true,
            'taxonomies' => array('post_tag')
        ),
        $labels = array(
            'menu_name' => 'Dharma Talks',
            'all_items' => 'All Dharma Talks',
            'name' => 'Dharma Talks',
            'singular_name' => 'Talk'
        );

    protected function addActions()
    {
        $this->wp->add_action('post_edit_form_tag', array($this, 'updateEditForm'));
    }

    public function updateEditForm()
    {
        global $post;
        if ($post->post_type === 'dharma_talk') {
            echo ' enctype="multipart/form-data"';
        }
    }
} 