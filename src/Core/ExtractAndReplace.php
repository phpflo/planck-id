<?php

namespace PlanckId\Core;

use PlanckId\Flo\InvokableFloComponent;
use PlanckId\Content\Content;

class ExtractAndReplace extends InvokableFloComponent
{   
    protected $ports = array(
        ['in', 'in', array()],
        ['out', 'extract'],
        ['out', 'replace'], 
    );

    /**
     * Aka: Repeat
     * @param string $content 
     */
    public function __invoke($content) {
        lineOut(__METHOD__);

        $this->sendThenDisconnect('replace', $content);
        $this->sendThenDisconnect('extract', (string) $content);
    }
} 
