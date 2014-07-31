<?php

namespace AudioDharma\Service;

use Exception;
use WP_Error;

class DharmaID3 implements ID3 {

    protected
        $id3_factory,
        $id3,
        $tag_settings
    ;

    public function __construct(Id3Factory $id3_factory)
    {
        $this->id3_factory = $id3_factory;
    }

    public function handle($file)
    {
        try {
            $handler = $this->getId3($file['tmp_name']);
            if (empty($this->tag_settings)) {
                throw new Exception('Tag settings are not configured, cannot audio file metadata. Upload aborted.');
            }
        } catch (Exception $e) {
            $this->wp->wp_die(new WP_Error($e->getCode(), $e->getMessage(), $e->getTrace()));
        }

        foreach($this->tag_settings as $tag_name => $value) {
            $frame_name = ucwords(strtolower($tag_name));
            $frame = $handler->$frame_name;

            if (is_subclass_of($frame, 'Zend_Media_Id3_TextFrame')) {
                $frame->setText($value);
            } elseif (is_subclass_of($frame, 'Zend_Media_Id3_LinkFrame')) {
                $frame->setLink($value);
            }
        }
        $handler->write($file['tmp_name']);
    }

    protected function getId3($filename, $options = null)
    {
        return $this->id3_factory->make($filename, $options);
    }

    public function configureTags(array $tags)
    {
        $this->tag_settings = $tags;
    }
}