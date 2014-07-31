<?php

namespace AudioDharma;

use AudioDharma\Base\BaseCustomPostType;

class Teacher extends BaseCustomPostType {

    protected
        $post_type = 'teacher',
        $args = array(
            'show_ui' => true,
            'show_in_menu' => true,
            'supports' => array('title', 'editor', 'thumbnail')
        ),
        $labels = array(
            'menu_name'             => 'Teachers',
            'all_items'             => 'All Teachers',
            'name'                  => 'Teachers',
            'singular_name'         => 'Teacher',
            'add_new'               => 'New Teacher',
            'new_item'              => 'New Teacher',
            'name_admin_bar'        => 'Teacher',
            'add_new_item'          => 'Add New Teacher',
            'edit_item'             => 'Edit Teacher',
            'view_item'             => 'View Teacher',
            'all_items'             => 'All Teachers',
            'search_items'          => 'Search Teachers',
            'not_found'             => 'No Teachers Found',
        );

} 