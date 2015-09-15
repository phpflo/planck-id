<?php 

namespace PlanckId\Replace;

use PlanckId\Flo\FloComponent;

/**
 * currently is a forwarder & is very reusable
 */
class Replace extends FloComponent {
    protected $ports = [['in', 'in', array()], 'out', ['out', 'regex'], ['out', 'content']];
    public function __construct() {
        $this->addPorts($this->ports);
        $this->inPorts['in']->on('data', [$this, 'keepItGoing']);
    }

    public function keepItGoing($data) {
        lineOut(__METHOD__);

        $this->outPorts['regex']->send($data);
        $this->outPorts['content']->send($data);
        $this->outPorts['out']->send($data);
        $this->outPorts['regex']->disconnect();
        $this->outPorts['content']->disconnect();
        $this->outPorts['out']->disconnect();
    }
}
