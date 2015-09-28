<?php 

namespace PlanckId\Replace;

use PlanckId\Flo\InvokableFloComponent;

/**
 * ReplaceStyles
 */
class FloStyle extends InvokableFloComponent { 
    protected $ports = ['in', ['out', 'styleblocks'], ['out', 'inlinestyles']];
    public function __invoke($data) {
        lineOut(__METHOD__);

        $this->outPorts['styleblocks']->send($data);
        $this->outPorts['styleblocks']->disconnect();
    }
}
