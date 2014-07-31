<?php

namespace AudioDharma\Service;

class Id3Factory {

    public function make($filename, $options) {
        return new \Zend_Media_Id3v2($filename, $options);
    }

} 