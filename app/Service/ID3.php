<?php

namespace AudioDharma\Service;

interface ID3 {

    public function handle($file);
    public function configureTags(array $tags);

}