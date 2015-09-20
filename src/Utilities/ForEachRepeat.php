<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\InvokableFloComponent;

class ForEachRepeat extends InvokableFloComponent
{    
    protected $ports = [['in', 'in', array()], ['out', 'error'], 'out'];

    /**
     * @param  array $data
     */
    public function __invoke($data) {
        lineOut(__METHOD__);
    
        if (!is_array($data) || !($data instanceof \Transversable)) {
            $this->sendIfAttached('error', "Argument `{$data}` is not an array or Transverable");
            throw new InvalidArgumentException("Argument `{$data}` is not an array or Transverable");
        }
        
        foreach ($data as $item) 
            $this->outPorts['out']->send($item);
            
        $this->outPorts['out']->disconnect();
    }
}