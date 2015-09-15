<?php 

namespace PlanckId\Replace;

/**
 * replace old selectors with new ones in CSS
 * 
 * @example 
 *  pass in  ...#selectors{} .selectors{} .selectors#selectors{}...
 *  replaces & returns ...#a{}, .b{}, .b#a{}...
 */
class ReplaceStyleSelectors extends AbstractNonMarkupPlanckOut
{   
    /**
     * @param  array<
     *          string $original what is being replaced
     *          string $new      what it is being replaced with
     *          string $subject  what contains the original> 
     *          $data
     * 
     * @flo string  after it has been replaced
     * 
     * @return void
     */
    public function __invoke($data) {
        lineOut(__METHOD__);
        // lineOut('data2:'); lineOut($data);
        // lineOut('matches2:'); lineOut($this->matches);
        
        # also str_replace any content in matches so that when it loops later we don't have old versions if one selector is replaced?
        $content = (string) $data['content'];
        
        // same as substring 1st position
        // [ ] need to do this a better way
        foreach ($this->matches as $key => $match) 
            if ($match[0] == '>') 
                unset($this->matches[$key]);
    
        foreach ($this->matches as $key => $match) {
            $replaced = $match;
            $replaced = str_replace('#' . $data['original'], '#' . $data['new'], $replaced);
            $replaced = str_replace('.' . $data['original'], '.' . $data['new'], $replaced);
            $content  = str_replace($match, $replaced, $content);     
            # should be [writeout]->WriteContent[in]
            $data['content']->setContent($content);

            $this->matches[$key] = $content;

            lineOut('replacing `'.$data['original'].'` with `'.$data['new'].'`');
            lineOut('using the $match:'); lineOut($match);
            lineOut('result_of_replace_is:'); lineOut($replaced);       
        }
        
        $this->content = $data['content'];
        $this->outPorts['out']->send($data['content']);
    }
}   
