<?php 

namespace PlanckId\Replace;

use PlanckId\Flo\FloComponent;
use PlanckId\Content\StaticContent;

/**
 * these are OUT 
 * 
 * @out string $original  what is being replaced
 * @out string $new       what it is being replaced with
 * @out string $subject   what contains the original
 */
class FloReplaceFinal extends FloReplace
{   
    public function identities() {
        lineOut(__METHOD__);
        $this->outPorts['identitiesout0']->send($this->identities);

        parent::identities();
    }
}   