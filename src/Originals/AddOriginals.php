<?php

namespace PlanckId\Originals;

use PlanckId\Flo\InvokableFloComponent;

/**
 * was AddIdentities
 */
class AddOriginals extends InvokableFloComponent {
    protected $ports = array(['in', 'in', []], ['out', 'error'], 'out', ['out', 'debug']);
   
    public function debug($data) {
        $this->sendIfAttached('debug', $data);
    }

    public function __invoke($originalsArray) {        
        lineOut(__METHOD__);
        $this->debug($originalsArray);
        $this->outPorts['out']->send($originalsArray);
    }
}