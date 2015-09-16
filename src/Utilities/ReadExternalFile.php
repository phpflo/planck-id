<?php

namespace PlanckId\Utilities;

class ReadExternalFile {
    protected $fileName;
    protected $content;

    public function setFileName($fileName) {
        $this->fileName($fileName);
    }

    // could also pass in the $fileName to the __invoke 
    public function __invoke() {
        $this->content = file_get_contents($this->fileName);
    }
}
