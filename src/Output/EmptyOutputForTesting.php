<?php

namespace PlanckId\Output;

use PlanckId\Flo\FloComponent;

class EmptyOutputForTesting extends FloComponent
{    
    public function __construct() {
        $this->addPorts([['in', 'in', array()], 'err', 'out']);
        $this->inPorts['in']->on('data', [$this, 'output']);
    }

    /**
     * @param  mixed  $data
     * @return void
     */
    public function output($data) {
    }
}