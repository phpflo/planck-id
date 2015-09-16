<?php

namespace PlanckId\Planck;

use PlanckId\Planck\PlanckCollectionIterator;

/**
 * previously named MinifiedIdValuesBuilder
 * 
 * A
 * AA
 * A1
 * A1A 
 * AA1
 * A11
 * AAA
 * A1AA
 * A11A
 * AAA1 
 */
class PlanckCollectionBuilder {
    /**
     * @return PlanckCollectionIterator
     */
    public static function built() {
        return (new Self)->build();
    }

    /**
     * [ ] add in special characters if needed such as `-` & `_`
     * [ ] Configuration for how many are needed to be generated
     *  
     * @return MinifiedIdentificationValuesIterator
     */
    public function build() {
        $values = array();
        $values = mergeArrayValues($values, $this->singleLetter());
        $values = mergeArrayValues($values, $this->letterLetter());
        $values = mergeArrayValues($values, $this->letterNumber());
        $values = mergeArrayValues($values, $this->letterNumberLetter());
        $values = mergeArrayValues($values, $this->letterNumberNumber());
        $values = mergeArrayValues($values, $this->letterLetterLetter());
    
        return new PlanckCollectionIterator($values);
    }
    /**
     * @return array range a-z
     */
    function singleLetter() {
        return range('a', 'z');
    }        
    /**
     * @return array range 0-9
     */
    function singleNumber() {
        return range(0, 9);
    }   
    /**
     * @return array aa-zz
     */
    function letterLetter() {
        return $this->appendLettersToEach($this->singleLetter());
    }
    /**
     * @return array a0-z9
     */
    function letterNumber() {
        return $this->appendNumbersToEach($this->singleLetter());
    }        
    /**
     * @return array aaa-zzz
     */
    function letterLetterLetter() {
        return $this->appendLettersToEach($this->letterLetter());
    }    
    /**
     * @return array a0a-z9z
     */
    function letterNumberLetter() {
        return $this->appendNumbersToEach($this->letterNumber());
    }    
    /**
     * @return array a00-z99
     */
    function letterNumberNumber() {
        return $this->appendNumbersToEach($this->letterNumber());
    }

    /**
     * @example
     *      input   [0 => 'a', 1 = 'b']
     *      return  [0 => 'a1', 1 => 'a2' ... 26 => 'b1', 27 => 'b2' ... ]
     * 
     * 
     * @param  array $arrayOfValues 
     * @return array     
     */
    function appendNumbersToEach($arrayOfValues) {
        $arrayToReturn = array();
        foreach ($arrayOfValues as $value)  
            foreach ($this->singleNumber() as $number)           
                $arrayToReturn[] = $value . $number;
        
        return $arrayToReturn;
    }

    /**
     * @example
     *      input   [0 => 'a', 1 = 'b']
     *      return  [0 => 'aa', 1 => 'ab' ... 26 => 'ba', 27 => 'bb' ... ]
     * 
     * 
     * @param  array $arrayOfValues 
     * @return array     
     */
    function appendLettersToEach($arrayOfValues) {
        $arrayToReturn = array();
        foreach ($arrayOfValues as $value) 
            foreach ($this->singleLetter() as $letter)          
                $arrayToReturn[] = $value . $letter;
            
        return $arrayToReturn;
    }
}