<?php 

namespace PlanckId\Replace;

/**
 * [ ] Classes, Identities
 * [ ] use downflows for more specific replacing
 */
class ReplaceJavaScript extends AbstractNonMarkupPlanckOut
{   
    public function __invoke($data) {        
        lineOut(__METHOD__);
        // lineOut('using $matches:'); lineOut($this->matches);
        // lineOut('replacing `'.$data['original'].'` with `'.$data['new'].'`');
        // lineOut('using identity:'); lineOut($data['original']);     

        /**
         * Essentially, we have 
         */
        $matchesCopy = [];
        $content = (string) $data['content'];
        foreach ($this->matches as $key => $match) {
            $matchesCopy[$key] = (string) $match;
            $replaced = str_replace($data['original'], $data['new'], $this->matches[$key]);
            $this->matches[$key] = $replaced;
            $content = str_replace($matchesCopy[$key], $replaced, $content);     
            $data['content']->setContent($content);
            lineOut('replacing `'.$data['original'].'` with `'.$data['new'].'`');
        }

        $this->outPorts['out']->send($data['content']);
    }
} 