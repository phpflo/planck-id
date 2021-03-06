<?php

namespace PlanckId\Replace;

use PlanckId\Flo\FloComponent;

/**
 * regexes should go to debugoutput with a debug out port?
 */
abstract class AbstractIdentitiesOut extends FloComponent {
    protected $identities = [];
    protected $content    = ""; # FullContent

    protected $ports = [
        ['in', 'content', array()],
        ['in', 'matchedcontent', array()],
        ['in', 'identities'],
        ['out', 'error'],
        'out'
    ];

    public function __construct() {
        $this->addPorts($this->ports);

        $this->inPorts['content']->on('data', [$this, 'setContent']);
        $this->inPorts['identities']->on('data', [$this, '__invoke']);
        $this->inPorts['identities']->on('disconnect', [$this, 'out']);
    }

    public function out() {
        $this->outPorts['out']->disconnect();
    }

    public function setContent($content) {
        lineOut(static::class . " " . __METHOD__);
        $this->content = $content;
    }
}