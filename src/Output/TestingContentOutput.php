<?php

namespace PlanckId\Output;

use Illuminate\Support\Arr;
use PlanckId\Flo\FloComponent;
use PlanckId\Emitter;

/**
 * was TestingOutput
 */
class TestingContentOutput extends FloComponent
{    
    public function __construct() {
        $this->addPorts([['in', 'in', array()], ['out', 'error'], 'out']);
        $this->inPorts['in']->on('data', [$this, 'output']);
    }

    /**
     * @param  mixed  $data
     * @return void
     */
    public function output($data) {
        lineOut(__METHOD__);
        lineOut($data);
        Emitter::emit('testing.output', $data);
    }
}