<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\InvokableFloComponent;

class ArrayKeys extends InvokableFloComponent
{
    /**
     * @param array $data
     */
    public function __invoke($data) {
        lineOut(__METHOD__);
        if (!is_array($data) && !($data instanceof \Transversable)) {
            $this->sendIfAttached('error', "Argument `{$data}` is not an array or Transverable");
            throw new InvalidArgumentException("Argument `{$data}` is not an array or Transverable");
        }

        $arrayKeys = array_keys($data);
        $this->outPorts['out']->send($arrayKeys);
        $this->outPorts['out']->disconnect();
    }
}