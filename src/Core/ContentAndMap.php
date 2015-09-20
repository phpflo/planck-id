<?php

namespace PlanckId\Core;

use PlanckId\Flo\FloComponent;
use PlanckId\Content\Content;

class ContentAndMap extends FloComponent
{   
    protected $ports = array(
        ['in', 'in', array()], 
        ['in', 'map', array()], 
        ['in', 'content', array()], 
        ['out', 'map'], 
        ['out', 'content'], 
    );

    public function __construct() {
        $this->addPorts($this->ports);
        $this->inPorts['in']->on('data', [$this, 'splitInputOut']);
        $this->inPorts['in']->on('content', [$this, 'content']);
        $this->inPorts['in']->on('map', [$this, 'map']);
    }

    public function splitInputOut($data) {
        lineOut(__METHOD__);
        $this->content($data);
        $this->map($data);
    }
       
    public function content($data) {
        lineOut(__METHOD__);

        if (!isset($data['content'])) 
            return;

        if (is_string($data['content'])) 
            return $this->sendThenDisconnect('content', new Content($data['content']));

        $this->sendThenDisconnect('content', $data['content']);
    }   

    public function map($data) {
        lineOut(__METHOD__);

        if (isset($data['map'])) 
            $this->sendThenDisconnect('map', $data['map']);
    }
} 
