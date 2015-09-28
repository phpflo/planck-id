<?php

namespace PlanckId\Core;

use PlanckId\Flo\FloComponent;
use PlanckId\Content\Content;

class ContentAndMap extends FloComponent
{   
    protected $ports = array(
        ['in', 'in', array()],
        ['in', 'mapoutfirst'],
        ['in', 'map', array()],
        ['in', 'last', array()],
        ['in', 'content', array()],
        ['out', 'content'],
        ['out', 'map'],
        ['out', 'out', array()],
    );

    public function __construct() {
        $this->addPorts($this->ports);
        $this->inPorts['in']->on('data', [$this, 'splitInputOut']);
        $this->inPorts['mapoutfirst']->on('data', [$this, 'splitInputOutMapOutFirst']);
        $this->inPorts['content']->on('data', [$this, 'contentInOut']);
        $this->inPorts['map']->on('data', [$this, 'mapInOut']);
        $this->inPorts['last']->on('data', [$this, 'outOut']);
    }

    public function outOut($data = null) {
        lineOut(__METHOD__);
        $this->sendIfAttached('out', $data);
    }

    public function splitInputOutMapOutFirst($data) {
        lineOut(__METHOD__);
        $this->map($data);
        $this->content($data);

        $this->sendIfAttached('out', $data);
    }

    public function splitInputOut($data) {
        lineOut(__METHOD__);
        $this->content($data);
        $this->map($data);

        $this->sendIfAttached('out', $data);
    }
       
    public function content($data) {
        lineOut(__METHOD__);

        if (!isset($data['content'])) {
            throw new Exception('content not set');
            return;
        }

        if (is_string($data['content'])) 
            return $this->contentInOut($data['content']);

        $this->sendThenDisconnect('content', $data['content'], false);
    }   

    public function contentInOut($content) {
        lineOut(__METHOD__);
        $this->sendThenDisconnect('content', new Content($content), false);    
        
        // if we have no map attached, this is the end
        #if (!$this->inPorts['map']->isAttached()) {lineOut('map not attached');$this->sendIfAttached('out', $content);}
    }   

    public function map($data) {
        lineOut(__METHOD__);

        if (isset($data['map']))
            $this->mapInOut($data['map']);        
    }    

    public function mapInOut($map) {
        lineOut(__METHOD__);
        $this->sendThenDisconnect('map', $map, false);        

        // if we have no content in attached, this is the end
        #if (!$this->inPorts['content']->isAttached()) {lineOut('content not attached');$this->sendIfAttached('out', $map);}
    }   
} 
