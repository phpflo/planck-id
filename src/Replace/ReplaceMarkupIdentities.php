<?php 

namespace PlanckId\Replace;

/**
 * replaces an old id, with a new one.
 * 
 * @example 
 *    pass in  <p id="a-long_selector-2">...</p>
 *    get back <p id="a">...</p>
 * 
 */
class ReplaceMarkupIdentities extends AbstractIdentitiesOut
{   
    /**
     * @param  array<
     *          string $original what is being replaced
     *          string $new      what it is being replaced with
     *          string $subject  what contains the original
     * 
     * @flo string  after it has been replaced
     * 
     * @return void
     */
    public function __invoke($data) {
        lineOut(__METHOD__);
        // lineOut(__METHOD__); lineOut('data:');lineOut($data); lineOut('this content:'); lineOut($this->content);
        $data['content']->setContent(str_replace(
            'id="'.$data['original'].'"', 
            'id="'. $data['new'] . '"', 
            $data['content']));

        $this->content = $data['content'];
        $this->outPorts['out']->send($data['content']);
    }
}  