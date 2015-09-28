<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\InvokableFloComponent;

class JsonEncode extends InvokableFloComponent
{
    /**
     * @param mixed $data
     */
    public function __invoke($data) {
        lineOut(__METHOD__);

        $this->outPorts['out']->send(json_encode($data));
        $this->outPorts['out']->disconnect();
    }
}