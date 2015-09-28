<?php

namespace PlanckId\Originals;

use PlanckId\Flo\InvokableFloComponent;

/**
 * was RemoveUselessIdentities
 */
class RemoveUselessOriginals extends InvokableFloComponent {
    public function __invoke($identityArray) {
        lineOut(__METHOD__);
        lineOut($identityArray);
        $identityArray = removeEmptyStringAndNullKeyAndValues($identityArray);
        lineOut("after useless removed");
        lineOut($identityArray);

        $this->outPorts['out']->send($identityArray);
        $this->outPorts['out']->disconnect();
    }
}