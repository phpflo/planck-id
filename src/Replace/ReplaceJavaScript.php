<?php

namespace PlanckId\Replace;

use Illuminate\Support\Arr;
use function substringAll;

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

        $matchesCopy = [];
        $content = (string) $data['content'];
       
        if (is_array($this->matches)) 
            for ($i = 0; $i <= (count($this->matches) / 2); $i++) 
                unset($this->matches[$i]);
            
        if (!is_array($this->matches)) 
            $this->matches = array($this->matches);

        // echo "WTF THIS MATCHES";
        // dump($this->matches);
        // $this->matches = end($matches);
       
        /*
        foreach ($this->matches as $key => $match) {
            preg_match_all('/(?<=\"|\')(?:.*?)('.$data['original'].')(?:.*?)(?=\"|\')/s', $match, $matches);
            $matches = Arr::flatten($matches);
            $matchCopy = "";

            echo "<h1>MATCHES:</h1> \n<br>";
            dump($matches);

            foreach ($matches as $key => $subMatch) {        
                $replacement = str_replace($data['original'], $data['new'], $subMatch);
                // $content = str_replace($match, $matchesImploded, $content);
                echo "REPLACMENT: \n<br>";
                dump($replacement);
                echo "MATCH: \n<br>";
                dump($subMatch);
                $content = $replacement;
                $matches[$key] = $replacement;
            }
            $data['content']->setContent($content);
        }
        */

    
        //NEED TO SEPERATE OUT THE SELECTOR STUFF, LIKE IT IS IN REPLACESTYLESELECTORS... 
        //FUCKING WEIRD AND SILLY... I KNOW I AM MISSING SOMETHING IN THE REGEX...
        
        // dump("JAVASCRIPT MATCHES: _______________<hr>");
        // dump($this->matches);
        foreach ($this->matches as $key => $match) {

            # with and without `.` & `#`
            #" match "
            #"match"
            #"match "
           
            // ([a-zA-Z0-9-\s]*)
            preg_match_all('/(?<=\'|")(.*?)(?=\'|\")/', $match, $matches);
            // echo "WTF MATCHES";
            // dump($matches);

            $matches = $matches[1];
            $matches = Arr::flatten($matches);
            $matchCopy = "";
            // echo "WTF MATCHES";
            // dump($matches);

            foreach ($matches as $match2) {        

                // if we remove the original, is there leftover? if so, it may be part of something else.
                // if (strlen(str_replace($data['original'], "", $match2))) 

                // we do not want to replace it if there are letters or numbers or - or _ before or after it
                // we do want to replace it if any other character is right before or after it

                $originalLength = strlen($data['original']);


                // what we want to replace is longer than the match, not possible.
                if ($originalLength > strlen($match2)) {
                    continue;
                }

                // ECHO "<H1>attempting to substring</H1>";
                // dump($match2);
                // dump($data['original']);
             
                $positions = substringAll($match2, $data['original']);
                $disallowedChars = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'), ['-', '_', '+',]);

                // ECHO "<H1>LINEOUT</H1>";
                // dump($positions);
            
                if (!empty($positions)) {
                    foreach ($positions as $position) {
                        // starting one character before, and going one character longer
                        
                        // ECHO "<H1>positionPlusMinusOnePos</H1>";
                        // dump($position);

                        $startingPosition = $position === 0 ? $position : $position - 1;
                        $positionPlusMinusOne = substr($match2, $startingPosition, $originalLength + 1);
                        $endOfPositionMinusOne = substr($positionPlusMinusOne, -1);
                        $endOfDataOriginal = substr($data['original'], -1);

                        
                       
                        // they are the same length as the original or match, nothing different.
                        // we know they are the same value, nothing different
                        if (strlen($positionPlusMinusOne) === $originalLength && 
                            $positionPlusMinusOne === strlen($match2) && 
                            $data['original'] === $positionPlusMinusOne) {
                            
                            $replaced = str_replace($data['original'], $data['new'], $match2);
                            $content = str_replace($match2, $replaced, $content);
                            // $data['content']->setContent($content);
                            //dump($data);
                            continue;
                        }
                        /*
                        ECHO "<H1>positionPlusMinusOne</H1>";
                        dump($positionPlusMinusOne);
                        dump($data['original']);
                        dump($originalLength + 1);
                        dump($position);
                        dump($startingPosition);
                        dump($match2);
                        dump($content);
                        */
                       
                        // we know the first char of both are not the same so we check
                        if ($data['original'][0] !== $positionPlusMinusOne[0])  {
                            if (containsAnySubStrings($positionPlusMinusOne[0], $disallowedChars)) {
                                // ECHO "<H1>IT HAS SOME SHIT in [0]</H1>";
                                // dump($positionPlusMinusOne[0]);
                                continue;
                            }
                        }


                        if ($endOfDataOriginal !== $endOfPositionMinusOne)  {     
                            if (containsAnySubStrings($endOfPositionMinusOne, $disallowedChars)) {
                                // ECHO "<H1>IT HAS SOME SHIT in end</H1>";
                                // dump($endOfPositionMinusOne);
                                continue;
                            }
                        }

                        $replaced = str_replace($data['original'], $data['new'], $match2);
                        $content = str_replace('"'.$match2.'"', '"'.$replaced.'"', $content);
                        $content = str_replace("'".$match2."'", "'".$replaced."'", $content);
                        $data['content']->setContent($content);
                        // echo("<h3>JAVASCRIPT replaced: </h3>");
                        // dump($replaced);
                        // dump($replaced);
                        //dump($data);
                        
                        /*
                        ECHO "<H1>positionPlusMinusOne</H1>";
                        dump($positionPlusMinusOne);
                        dump($data['original']);
                        dump($originalLength + 1);
                        dump($position);
                        dump($startingPosition);
                        dump($match2);
                        */
                    }
                } /*else {
                    
                    $replaced = str_replace($data['original'], $data['new'], $match2);
                    $content = str_replace($match2, $replaced, $content);
                    echo("<h3> elsed</h3>");
                    dump($data['original']);
                    dump($data['new']);
                    dump($match2);
                    dump($replaced);
                    dump($data);
                    
                    // dump($content);
                }*/
            }
            $data['content']->setContent($content);
            // echo("<h3>JAVASCRIPT match: </h3>");
            // dump($match2);
            // dump($data);
        } 

        $this->sendIfAttached('out', $data['content']);
    }



    # $replaced = preg_replace('/(?<=\"|\')(?:.*?)('.$data['original'].')(?:.*?)(?=\"|\')/', '__b4__$0__post__', $this->matches[$key]);


    function replaceLikeMarkup($content, $data) {            


        $matchesCopy[$key] = (string) $match;
            





            preg_match_all('/(?<=\"|\')([a-zA-Z0-9-\s]*)(?=\"|\')/s', $match, $matches);
            $matches = Arr::flatten($matches);
            $matchCopy = "";

            echo "<h1>MATCHES:</h1>";
            dump($matches);
            dump($data);

            foreach ($matches as $match) {        
                $matchesExploded = explode(" ", $match);
                foreach ($matchesExploded as $key => $subMatch) {
                    $matchesExploded[$key] = str_replace($data['original'], $data['new'], $subMatch);
                }
                $matchesImploded = implode(" ", $matchesExploded);
                $content = str_replace($match, $matchesImploded, $content);
            }
            $data['content']->setContent($content);


            //$replaced = preg_replace('/(?:\"|\'?)(?:.*?)('.$data['original'].')(?:.*?)(?=\"|\')/s', '__b4__$0__post__', $this->matches[$key]);

            // dump("JAVASCRIPT MATCHES: _______________<hr>");
            // dump($match);(?<=\"|\')
            /*
            $replaced = preg_replace_callback('/(?:\"|\'?)(?:.*?)('.$data['original'].')(?:.*?)(?=\"|\')/s', 
                function($matches) use ($data) {
                    dump("DUH HELLO!");
                    dump($matches);
                    
                    $matchzzz = end($matches);
                    dump($matchzzz);
                    dump($data['new']);

                    if ($matchzzz == $data['original'])
                        return $data['new'];
                    
                    return $matchzzz;
                },
                $this->matches[$key]
            );
          
           
            // $replaced = str_replace($data['original'], $data['new'], $this->matches[$key]);
            $this->matches[$key] = $replaced;
            $content = str_replace($matchesCopy[$key], $replaced, $content);
            $data['content']->setContent($content);
            // dump('replacing `'.$data['original'].'` with `'.$data['new'].'`');
            */
    }

}
