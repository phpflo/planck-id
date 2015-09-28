<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\FloComponent;

class StringToArray extends FloComponent
{
    protected $delimiter = ',';

    public function __construct() {
        $this->addPorts([['in', 'in', array()], ['in', 'delimiter', array()], ['out', 'error'], 'out']);
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

        if (is_string($data))
            $data = explode($this->delimiter, $data);

        $this->outPorts['out']->send($data);
        $this->outPorts['out']->disconnect();
    }
}