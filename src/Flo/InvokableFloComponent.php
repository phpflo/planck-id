<?php

namespace PlanckId\Flo;

/**
 * calls the `__invoke` function on its children to prevent unessecary duplication in setup
 */
abstract class InvokableFloComponent extends FloComponent {
    protected $ports = array();
    public function __construct() {
        if (!empty($this->ports))
            $this->addPorts($this->ports);
        else 
            $this->addPorts([['in', 'in', array()], 'err', 'out']);
            
        $this->inPorts['in']->on(
            'data', 
            function($data) { 
                return static::__invoke($data); 
            }
        );
    }
}
