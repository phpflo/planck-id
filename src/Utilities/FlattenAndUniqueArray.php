<?php 

namespace PlanckId\Utilities;

use PlanckId\Flo\InvokableFloComponent;

class FlattenAndUniqueArray extends InvokableFloComponent
{   
    /**
     * @param array $data 
     * @return void
     */
    public function __invoke($data) {
        $data = Arr::flatten($data);    
        $data = array_unique($data);
        
        $this->outPorts['out']->send($data);
        $this->outPorts['out']->disconnect();
    }
} 