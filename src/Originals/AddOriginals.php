<?php

namespace PlanckId\Originals;

use PlanckId\Flo\InvokableFloComponent;

/**
 * was AddIdentities
 */
class AddOriginals extends InvokableFloComponent {
    protected $ports = array(['in', 'in', []], 'error', 'out', ['out', 'debug']);
   
    public function __construct() {
        $this->addPorts($this->ports);
        $this->inPorts['in']->on('data', [$this, '__invoke']);
    }

    public function debug($data) {
        if ($this->outPorts['debug']->isConnected())
            $this->outPorts['debug']->send($data);
    }

    public function __invoke($identityArray) {        
        lineOut(__METHOD__);
        $this->debug($identityArray);
        $this->outPorts['out']->send($identityArray);
    }
}