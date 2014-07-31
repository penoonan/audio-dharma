<?php

namespace AudioDharma\Repo;

use AudioDharma\Base\WpApiWrapper;

class Teacher {

    protected $wp;

    public function __construct(WpApiWrapper $wp)
    {
        $this->wp = $wp;
    }

    public function all()
    {
        return $this->wp->get_posts(array(
            'post_type' => 'dharma_teacher',
            'posts_per_page' => -1
        ));
    }

    public function allKV()
    {
        $teachers = $this->all();
        $result = array();
        foreach($teachers as $teacher) {
            $result[$teacher->ID] = $teacher->post_title;
        }
        return $result;
    }

    public function getPostTeacher($post_id)
    {
        return $this->wp->get_post_meta($post_id, 'teacher', true);
    }

    public function savePostTeacher($post_id, $teacher_id)
    {
        $this->wp->update_post_meta($post_id, 'teacher', $teacher_id);
    }

    public function find($id) {
        return $this->wp->get_post($id);
    }

} 