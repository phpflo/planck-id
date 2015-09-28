<?php

namespace PlanckId\Core;

use PlanckId\Flo\InvokableFloComponent;
use PlanckId\Content\Content;

class ExtractOriginals extends InvokableFloComponent
{
    protected $ports = array(
        ['in', 'in', array()],
        ['out', 'style'],
        ['out', 'markup'],
        ['out', 'script'],
    );

    /**
     * Aka: Repeat
     * @param string $content
     */
    public function __invoke($content) {
        lineOut(__METHOD__);

        $this->sendThenDisconnectAll(['style', 'markup', 'script'], $content);
    }
}
