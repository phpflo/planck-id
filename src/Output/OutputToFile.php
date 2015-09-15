<?php

namespace PlanckId\Output;

use PlanckId\Flo\FloComponent;

class OutputToFile extends FloComponent
{    
    protected $file = 'output.php';

    public function __construct() {
        $this->addPorts([['in', 'in', array()], ['in', 'file', array()], 'err', 'out']);
        $this->onIn('file', 'data', 'setFile');
        $this->onIn('in', 'data', 'output');
    }       

    /**
     * @param string $fileName 
     */
    public function setFile($fileName) {
        $this->file = $fileName;
    }

    /**
     * @param  mixed  $data
     * @return void
     */
    public function output($data) {
        if (!is_string($data)) 
            $data = var_export($data, true);

        $fp = fopen($this->file, 'w+');
        fwrite($fp, $data);
        fclose($fp);

        lineOut(__METHOD__);
        // lineOut($data);
    }
}