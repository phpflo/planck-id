<?php

namespace PlanckId\Output;

use PlanckId\Flo\FloComponent;
use PlanckId\Emitter;

/**
 * class OutputNonMinified extends FloComponent {}
 * Aka Output Original Identities
 */
class OutputOriginalForTesting extends FloComponent
{    
    public function __construct() {
        $this->addPorts([['in', 'in', array()], ['out', 'error'], 'out']);
        $this->inPorts['in']->on('data', [$this, 'output']);
    }

    /**
     * @param  mixed $data
     * @return void
     */
    public function output($data) {
        if (is_array($data)) {
            $dataOut = array_keys($data);
            $dataOut = implode(",", $dataOut);
            
            lineOut($dataOut);

            Emitter::emit('testing.output', $dataOut);
        }
    }
}