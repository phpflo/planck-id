<?php

namespace PlanckId;

use PlanckId\Flo\FloComponent;

/**
 * A repeater to Style Blocks + Inline for Identities + Classes
 */
class StyleRegexRepeater extends FloComponent {
    protected $ports = [['in', 'styleblocks'], ['in', 'inlinestyles'], ['out', 'classes'], ['out', 'identities']];

    public function __construct() {
        $this->addPorts($this->ports);

        $this->inPorts['styleblocks']->on('data', [$this, 'blocks']);
        $this->inPorts['styleblocks']->on('disconnect', [$this, 'outs']);

        # $this->inPorts['inlinestyles']->on('data', [$this, 'inline']);
        # $this->inPorts['inlinestyles']->on('disconnect', [$this, 'outs']);
    }

    public function blocks($data) {
        lineOut(__METHOD__);
        if (is_array($data))
            $data = implode("", $data);

        lineOut($data);

        $this->outPorts['classes']->send($data);
        $this->outPorts['identities']->send($data);
    }

    public function inline($data) {
        lineOut(__METHOD__);
        $this->outPorts['classes']->send($data);
        $this->outPorts['identities']->send($data);
    }

    public function outs() {
        lineOut(__METHOD__);
        $this->outPorts['classes']->disconnect();
        $this->outPorts['identities']->disconnect();
    }
}