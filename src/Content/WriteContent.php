<?php

namespace PlanckId\Content;

use PlanckId\Flo\InvokableFloComponent;

class WriteContent extends InvokableFloComponent
{    
    public function __invoke($data) {    
        StaticContent::$content = $data;
        $this->outPorts['out']->send($data);
        $this->outPorts['out']->disconnect();
    }
}
class WriteContentFinal extends InvokableFloComponent
{    
    public function __invoke($data) {    
        StaticContent::$content = $data;
    }
}