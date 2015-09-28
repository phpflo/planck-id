<?php

namespace PlanckId\Replace;

use Illuminate\Support\Arr;

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

        // (?:\s|\")
        #'/(?<=class\=)(?:\"|\')(?:[a-zA-Z0-9\s]*?)\b('.$data['original'].')\b(?=\"|\'|\s)/s',

        // could match them all, explode it, make a copy, replace it...
        
        $content = (string) $data['content'];    
        preg_match_all('/(?<=class\=\")([a-zA-Z0-9-\s]*)(?=\")/s', $content, $matches);
        $matches = Arr::flatten($matches);
        $matchCopy = "";

        // echo "CLEAN UP MATCH: ". __METHOD__;
        foreach ($matches as $match) {        
            $matchesExploded = explode(" ", $match);
            foreach ($matchesExploded as $key => $subMatch) {
                $matchesExploded[$key] = str_replace($data['original'], $data['new'], $subMatch);
            }
            $matchesImploded = implode(" ", $matchesExploded);
            $content = str_replace($match, $matchesImploded, $content);
        }
        $data['content']->setContent($content);

        /*
        $data['content']->setContent(preg_replace(
            '/(?<=class\=)(?:\"|\')(?:[a-zA-Z0-9\s]*?)\b('.$data['original'].')\b(?:\"|\')(?:[a-zA-Z0-9\s]*?)(?=\"|\'|\s)/',
            $data['new'],
            $data['content']));
        */
       
        // $this->content = $data['content'];
        $this->sendIfAttached('out', $data['content']);
    }
}