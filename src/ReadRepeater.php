<?php

namespace PlanckId;

use PlanckId\Flo\InvokableFloComponent;
use PlanckId\Content\Content;

/**
 *  From the File Read sending it out to Content, Style, Markup
 */
class ReadRepeater extends InvokableFloComponent
{   
    protected $ports = array(
        ['in', 'in', array()], 
        ['out', 'error'],
        ['out', 'style'], 
        ['out', 'markup'], 
        ['out', 'replace'], 
        ['out', 'contentout'],
        ['out', 'final'],
    );

    /**
     * Aka: Repeat
     * @param  string $content 
     */
    public function __invoke($content) {
        lineOut(__METHOD__ . ' ' . '(Repeat)');
        // lineOut($content);

        $this->outPorts['contentout']->send(new Content($content));
        $this->outPorts['contentout']->disconnect();

        $this->outPorts['style']->send($content);
        $this->outPorts['style']->disconnect();

        $this->outPorts['markup']->send($content);
        $this->outPorts['markup']->disconnect();
    }
} 