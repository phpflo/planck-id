<?php 

namespace PlanckId\Replace;

/** 
 * @return @TODO [ ] needs work - could do same as matching <style> then replacing :D
 * 
 * replaces an old id, with a new one.
 * @example 
 *      passing in `a-long_selector-2` it
 *      matches `a-long_selector-2` in <p class="a-long_selector-2 adifferentSelector">...</p>
 * 
 * @param  string   $original  what is being replaced
 * @param  string   $new       what it is being replaced with
 * @param  string   $subject   what contains the original
 * @return string   after it has been replaced
 */
class ReplaceMarkupClasses extends AbstractIdentitiesOut
{   
    public function __invoke($data) {        
        lineOut(__METHOD__); lineOut('ReplaceMarkupClasses');
        // lineOut('data:'); lineOut($data); lineOut('this content:'); lineOut($this->content);

        $data['content']->setContent(preg_replace(
            '/(?<=class\=\"|\s)\b('.$data['original'].')\b(?=\"|\s)/', 
            $data['new'], 
            $data['content']));    
        
        $this->content = $data['content'];   
        $this->outPorts['out']->send($data['content']);
    }
}   