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
        $this->addPorts([['in', 'in', array()], 'err', 'out']);
        $this->inPorts['in']->on('data', [$this, 'output']);
    }

    /**
     * @param  mixed  $data
     * @return void
     */
    public function output($data) {
        if (is_array($data)) {
            $data = Arr::flatten($data);    
            $data = array_unique($data);
            $data = implode(",", $data);
        }
        lineOut(__METHOD__);
        lineOut($data);
        Emitter::emit('testing.output', $data);
    }
}