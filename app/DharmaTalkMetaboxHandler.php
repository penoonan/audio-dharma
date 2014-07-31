<?php

namespace AudioDharma;

use AudioDharma\Base\MetaboxHandler;
use AudioDharma\Base\Request;
use AudioDharma\Repo\AudioFile;
use AudioDharma\Repo\Teacher;
use League\Plates\Template;

class DharmaTalkMetaboxHandler implements MetaboxHandler {

    /**
     * @var \League\Plates\Template
     */
    private $template;

    /**
     * @var Repo\Teacher
     */
    private $teacher;

    /**
     * @var Repo\AudioFile
     */
    private $audio_file;

    /**
     * @var Base\Request
     */
    private $request;

    public function __construct(Template $template, Teacher $teacher, AudioFile $audio_file, Request $request)
    {
        $this->template = $template;
        $this->teacher = $teacher;
        $this->audio_file = $audio_file;
        $this->request = $request;
    }

    public function handle($args)
    {
        $post = $args[0];
        $data = array (
            'post' => $post,
            'metabox' => $args[1],
            'teachers' => $this->teacher->allKV(),
            'selected_teacher' => $this->teacher->getPostTeacher($post->ID),
            'audio_file' => $this->audio_file->getPostAudioFile($post->ID)
        );

        echo $this->template->render('dt_metabox', $data);
    }

    public function save($post_id, $post)
    {
        if (empty($post['post_type']) || $post['post_type'] !== 'dharma_talk' || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE === true)) {
            return null;
        }

        if (ctype_digit($post['dharma_talk_teacher'])) {
            $this->teacher->savePostTeacher($post_id, $post['dharma_talk_teacher']);
        }

        $file = $this->request->files('dharma_talk_audio_file');
        if ($file && $file['type'] === 'audio/mp3') {
            $this->audio_file->attachDharmaTalkFileToPost($file,  $post_id);
        }
    }
}