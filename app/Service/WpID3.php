<?php

namespace AudioDharma\Service;

class WpID3 implements ID3 {

    protected $id3;

    function __construct(\getID3 $id3)
    {
        $this->id3 = $id3;
    }


    public function analyze($filename)
    {
        return $this->id3->analyze($filename);
    }

    public function setTags($file)
    {
        // TODO: Implement setTags() method.
    }
}