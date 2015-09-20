<?php

namespace PlanckId\Output;

use Illuminate\Support\Arr;
use PlanckId\Flo\FloComponent;
use PlanckId\Emitter;

/**
 * 
 */
class DisplayOutputForTesting extends FloComponent
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
        if (is_array($data)) {
            $dataString = Arr::flatten($data);    
            $dataString = array_unique($dataString);
            $dataString = implode(",", $dataString);
            Emitter::emit('test.output', $dataString);
            lineOut($dataString);
        }
        lineOut(__METHOD__ . ' - original;');
        lineOut($data);
    }
}