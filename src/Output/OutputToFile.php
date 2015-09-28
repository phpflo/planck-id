<?php

namespace PlanckId\Output;

use PlanckId\Flo\FloComponent;

class OutputToFile extends FloComponent
{    
    protected $file = 'output.php';

    public function __construct() {
        $this->addPorts([['in', 'in', array()], ['in', 'file', array()], ['out', 'error'], 'out']);
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
        lineOut(__METHOD__);
       
        if (is_object($data) && method_exists($data, '__toString')) 
            $data = $data->__toString();

        if (!is_string($data)) 
            $data = var_export($data, true);

        $fileHandler = fopen($this->file, 'w+');
        fwrite($fileHandler, $data);
        fclose($fileHandler);

        // lineOut($data);
    }
}