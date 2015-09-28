<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\FloComponent;

class Callback extends FloComponent
{    
    /**
     * @param Callable $callback
     */
    protected $callback;

    public function __construct() {
        $this->addPorts([['in', 'in', array()], ['in', 'callback', array()], ['out', 'error']]);
        $this->onIn('callback', 'data', 'setCallback');
        $this->onIn('in', 'data', 'call');
    }

    /**
     * @param Callable $callback
     */
    public function setCallback(Callable $callback) {
        lineOut(__METHOD__);

        $this->callback = $callback;
    }

    /**
     * @param  string $data
     * @return void
     */
    public function call($data) {
        lineOut(__METHOD__);

        $callback = $this->callback;
        $callback($data);
    }
}