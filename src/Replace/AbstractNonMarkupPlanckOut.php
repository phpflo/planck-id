<?php

namespace PlanckId\Replace;

abstract class AbstractNonMarkupPlanckOut extends AbstractIdentitiesOut {
    protected $matches = []; # MatchedContent

    public function __construct() {
        parent::__construct();
        $this->addPorts([['in', 'match'], 'out']); #[ ] ['out', 'writecontent']
        $this->inPorts['match']->on('data', [$this, 'addMatch']);
    }

    public function addMatch($data) {
        lineOut(__METHOD__);
        // lineOut($data);
        $this->matches = array_merge((array)$data, $this->matches);
    }
}
