<?php

namespace PlanckId\Content;

use PlanckId\Flo\InvokableFloComponent;

class WriteContent extends InvokableFloComponent
{    
    public function __invoke($data) {
        StaticContent::$content = $data;
        $this->sendThenDisconnect('out', $data);
    }
}