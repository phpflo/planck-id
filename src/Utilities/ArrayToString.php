<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\FloComponent;

class ArrayToString extends FloComponent
{    
    protected $delimiter = ',';

    public function __construct() {
        $this->addPorts([['in', 'in', array()], ['in', 'delimiter', array()], 'error', 'out']);
        $this->onIn('delimiter', 'data', 'setDelimiter');
        $this->onIn('in', 'data', 'output');        
    }    

    /**
     * @param string $delimiter 
     */
    public function setDelimiter($delimiter) {
        $this->delimiter = $delimiter;
    }

    /**
     * @param  string $data
     * @return void
     */
    public function output($data) {
        lineOut(__METHOD__);
    
        if (is_array($data) || $data instanceof \Transversable) 
            $data = implode($this->delimiter, $data);
       
        lineOut($data);

        $this->outPorts['out']->send($data);
        $this->outPorts['out']->disconnect();
    }
}