<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\InvokableFloComponent;

class ReadExternalFile extends InvokableFloComponent {
    protected $fileName;
    protected $content;

    public function setFileName($fileName) {
        $this->fileName($fileName);
    }

    // could also pass in the $fileName to the __invoke 
    public function __invoke($fileName) {
        $this->content = file_get_contents($this->fileName);
    }
}