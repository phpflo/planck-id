<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\InvokableFloComponent;

abstract class AbstractExternalFile extends InvokableFloComponent {
    protected $fileName;
    protected $content;
    protected $ports = array(['out', 'out', []]);

    public function setFileName($fileName) {
        $this->fileName = $fileName;
    }        
}