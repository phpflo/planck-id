<?php 

namespace PlanckId\Replace;

class ReplaceJavaScriptContent extends AbstractNonMarkupPlanckOut
{   
    public function __invoke($data) {        
        // lineOut(__METHOD__);
        // lineOut('using $matches:'); lineOut($this->matches);
        // lineOut('replacing `'.$data['original'].'` with `'.$data['new'].'`');

        # also str_replace any content in matches so that when it loops later we don't have old versions if one selector is replaced?
        $content = (string) $data['content'];

        foreach ($this->matches as $match) {
            $replaced = str_replace($data['original'], $data['new'], $match);
            // lineOut('replacing `'.$data['original'].'` with `'.$data['new'].'`');
            // lineOut('using the $match:'); lineOut($match); lineOut('result_of_replace_is:'); lineOut($replaced);       
            // lineOut('using the $content:'); lineOut($content);
            $content = str_replace($match, $replaced, $content);     

            # should be [writeout]->WriteContent[in]
            $data['content']->setContent($content);
        }
        
        $this->content = $data['content'];
        // lineOut('using the $content:'); lineOut($data['content']);
        $this->outPorts['out']->send($data['content']);
    }
}   