<?php

namespace PlanckId;

use PlanckId\Flo\InvokableFloComponent;

/**
 * A repeater to Identities + Classes for Markup
 */
class FloMarkup extends InvokableFloComponent {
    protected $ports = ['in', ['out', 'classes'], ['out', 'identities']];
    public function __invoke($data) {
        $this->outPorts['identities']->send($data);
        $this->outPorts['identities']->disconnect();

        $this->outPorts['classes']->send($data);
        $this->outPorts['classes']->disconnect();
    }
}