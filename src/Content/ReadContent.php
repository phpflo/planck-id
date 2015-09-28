<?php

namespace PlanckId\Content;

use PlanckId\Flo\InvokableFloComponent;

/**
 * replaceIdentity
 *      could have a statefull $subject
 *      use events to change it
 */
class ReadContent extends InvokableFloComponent
{
    public function __invoke() {
        lineOut(__METHOD__);
        $data = StaticContent::$content;
        // lineOut($data);
       
        $this->sendThenDisconnect('out', $data);
    }
}
