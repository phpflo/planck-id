<?php 

namespace PlanckId\Replace;

use PlanckId\Flo\InvokableFloComponent;

/**
 * currently is a forwarder & is very reusable
 */
class Replace extends InvokableFloComponent {
    protected $ports = [['in', 'in', array()], 'out', ['out', 'regex'], ['out', 'content']];

    public function __invoke($data) {
        lineOut(__METHOD__);

        $this->outPorts['regex']->send($data);
        $this->outPorts['content']->send($data);
        $this->outPorts['regex']->disconnect();
        $this->outPorts['content']->disconnect();

        $this->sendThenDisconnect('out', $data);
    }
}
