<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\InvokableFloComponent;

class JsonDecode extends InvokableFloComponent
{
    /**
     * @var boolean
     */
    protected $asArray = true;

    public function __construct() {
        $this->addPorts([['in', 'in', array()], ['in', 'asarray', array()], ['in', 'asobject', array()], ['out', 'out', array()]]);
        $this->onIn('asarray', 'data', 'asArray');
        $this->onIn('asobject', 'data', 'asObject');
        $this->onIn('in', 'data', '__invoke');
    }

    /**
     * @param bool $data
     */
    public function asArray($state = true) {
        lineOut(__METHOD__);
        $this->asArray = $state;
    }

    /**
     * @param bool $data
     */
    public function asObject($state = true) {
        lineOut(__METHOD__);
        $this->asArray = !$state;
    }

    /**
     * @param mixed $data
     */
    public function __invoke($data) {
        lineOut(__METHOD__);

        $this->outPorts['out']->send(json_decode($data, $this->asArray));
        $this->outPorts['out']->disconnect();
    }
}