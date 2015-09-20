<?php

namespace PlanckId\Originals;

use PlanckId\Flo\InvokableFloComponent;
use PlanckId\Planck\OriginalAndPlanckMap;

class WriteOriginalAndPlanckMap extends InvokableFloComponent {
    public function __invoke($originalAndPlanckMap) {
        OriginalAndPlanckMap::$map = $originalAndPlanckMap;
                
        $this->sendThenDisconnect('out', $originalAndPlanckMap);
    }
}