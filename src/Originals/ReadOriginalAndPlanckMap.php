<?php

namespace PlanckId\Originals;

use PlanckId\Flo\InvokableFloComponent;
use PlanckId\Planck\OriginalAndPlanckMap;

/**
 *  was ReadIdentities
 */
class ReadOriginalAndPlanckMap extends InvokableFloComponent {
    protected $ports = array('in', 'out');
    public function __invoke($identityArray = null) {
        $this->outPorts['out']->send(OriginalAndPlanckMap::$newIdentities);
    }
}