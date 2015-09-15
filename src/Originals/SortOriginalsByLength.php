<?php

namespace PlanckId\Originals;

use PlanckId\Flo\InvokableFloComponent;

/**
 * was SortIdentitiesByLength
 */
class SortOriginalsByLength extends InvokableFloComponent {
    public function __invoke($identityArray) {
        lineOut(__METHOD__);
        
        lineOut($identityArray);
        $identities = sortByKeyLength($identityArray);        
       
        lineOut($identities);
        if (!isAssociativeArray($identities)) 
            $identities = sortByLength($identityArray);        
        lineOut($identities);

        $this->outPorts['out']->send($identities);
        $this->outPorts['out']->disconnect();
    }
}