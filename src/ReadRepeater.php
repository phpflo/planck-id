<?php

namespace PlanckId;

use PlanckId\Flo\FloComponent;
use PlanckId\Content\Content;

/**
 *  From the File Read sending it out to Content, Style, Markup
 */
class ReadRepeater extends FloComponent
{   
    public function __construct() {
        $this->addPorts(array(
            ['in', 'in', array()], 
            'error', 
            ['out', 'style'], 
            ['out', 'markup'], 
            ['out', 'replace'], 
            ['out', 'contentout'],
            ['out', 'final'],
        ));

        $this->inPorts['in']->on('data', [$this, 'repeat']);
    }

    public function repeat($content) {
        lineOut(__METHOD__);
        lineOut($content);

        $this->outPorts['contentout']->send(new Content($content));
        $this->outPorts['contentout']->disconnect();

        $this->outPorts['style']->send($content);
        $this->outPorts['style']->disconnect();

        $this->outPorts['markup']->send($content);
        $this->outPorts['markup']->disconnect();
    }
} 