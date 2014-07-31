<?php

namespace AudioDharma\Repo;

use AudioDharma\Base\WpApiWrapper;
use AudioDharma\Service\ID3;

class AudioFile {

    protected
        $wp,
        $id3
    ;

    public function __construct(WpApiWrapper $wp, ID3 $id3)
    {
        $this->wp = $wp;
        $this->id3 = $id3;
    }

    public function attachDharmaTalkFileToPost(&$file, $post_id) {

        $this->id3->handle($file);

        $file = $this->wp->wp_handle_upload($file, array('test_form' => FALSE));
        $attachment = $this->wp->wp_insert_attachment($post_id, $file['file']);
        $this->wp->update_post_meta($post_id, 'dharma_talk_audio_file', $attachment);
    }

    public function getPostAudioFile($post_id)
    {
        $file_id = $this->wp->get_post_meta($post_id, 'dharma_talk_audio_file', true);
        return $this->wp->wp_get_attachment_url($file_id);
    }
} 