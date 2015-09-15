<?php 

use Illuminate\Support\Arr;

###########################################
# Utilities
###########################################
function lineOut($content) {
    #if (defined('DEBUGGING_PLANCK') && true === DEBUGGING_PLANCK) {
        echo PHP_EOL . PHP_EOL;
        dump($content);
        echo PHP_EOL . PHP_EOL;
}
function alwaysOutput($content) {
    dump($content);
}


/**
 * @example
 *     input   [0 => array(), 1, 2, 3]
 *     return  true
 * 
 * @example
 *     input   [0, 1, 2, 3]
 *     return   false
 * 
 * @param  [type]  $array [description]
 * @return boolean        [description]
 */
function isMultiDimensionalArray($array) {
    foreach ($array as $value) 
        if (is_array($value)) 
            return true;

    return false;
}

function containsSubString($haystack, $needle) {
    return false !== strpos($haystack, $needle);
}
/**
 * [ ] @PARAM $TYPE = ASC or DESC or callback?
 * would be a flow component
 *
 * takes the array, sorts it by the key length
 * @example 
 *      pass in ['1' => true, '11' => true]
 *      returns ['11' => true, '1' => true]
 * 
 * @param array $array  
 * return array
 */
function sortByKeyLength($array) {
    uksort(
        $array, 
        function($a, $b) { 
            return strlen($b) - strlen($a);
        }
    );
    return $array;
}
/**
 * takes the array, sorts it by the value length
 * @example 
 *      pass in ['1', '11']
 *      returns ['11', '1']
 * 
 * @param array $array  
 * return array
 */
function sortByLength($array) {
    usort(
        $array, 
        function($a, $b) { 
            return strlen($b) - strlen($a);
        }
    );
    return $array;
}

/**
 * @param  array   $array 
 * @return boolean        
 */
function isAssociativeArray(array $array) {
    return (bool) count(array_filter(array_keys($array), 'is_string'));
}

/**
 * @param  array|mixed $array 
 * @param  array       $out 
 * @return void
 */
function imploded($array, $out = null) {
    if (is_array($array)) 
        $imploded = implode(',', $array);
    else
        $imploded = $array;

    out($out, $imploded);
}
/**
 * @example
 *      input   [0 => 'cat', 1 => 'dog'], [0 => 'foo', 1 => 'bar']
 *      return  [0 => 'cat', 1 => 'dog', 2 => 'foo', 3 => 'bar']
 * 
 * @param  array $array1 
 * @param  array $array2 
 * @return array
 */
function mergeArrayValues($array1, $array2) {
    return array_merge(array_values($array1), array_values($array2));
}
/**
 * [ ] add call_user_func_array, this was just for functions with an array @param
 * 
 * pass in a callable and the stuff you want to pass into it
 * if it is not an array, make it one
 * 
 * @example
 *    
 * 
 * @param  Callable|string $callable 
 * @param  array|mixed     $content  
 * @return void
 */
function out(Callable $callable, $content) {
    if (!is_string($callable) && !is_callable($callable) || is_array($callable)) {
        lineOut(["out callable", $callable, "out callable content", $content]);
        throw new InvalidArgumentException("argument was a not a valid argumet, must be a callable|string : " . var_export($callable, true));
    }

    if (!is_array($content))
        $content = array($content);

    if (is_callable($callable)) 
        return $callable($content);

    if (is_string($callable) && function_exists($callable)) 
        return $callable($content);
}
/**
 * Convenience method for one line preg match
 * 
 * @param  string $x 
 * @param  string $regex               
 * @return array
 */
function pregMatchAll($x, $regex) {
    $match = preg_match_all($regex, $x, $matches);
    return $matches;
}
/**
 * [ ] removeEmptyStringAndNullKeys
 * [ ] removeEmptyStringAndNullValues
 * [ ] refactor to pipeline
 * 
 * @param  array  &$array 
 * @return array
 */
function removeEmptyStringAndNullKeyAndValues(&$array = array()) {
    // one piece, remove empties
    foreach ($array as $key => $value) {
        if (is_array($value)) 
            $array[$key] = removeEmptyStringAndNullKeyAndValues($value);
        if ("" === $key || null === $key) 
            unset($array[$key]);
        if ("" === $value || null === $value) 
            unset($array[$key]);
    }

    return $array;
}
/**
 * [ ] also check if it has sub arrays
 * @param  array  &$array 
 * @return array
 */
function removeEmptyArrays(&$array = array()) {
    foreach ($array as $key => $value) 
        if (is_array($value) && count($value) == 0) 
            unset($array[$key]);

    return $array;
}

/**
 * @param  array         $array 
 * @param  callable      $out  
 * @return void       
 */
function flattenUniqueOut($out, $array) {
    $flatArray = Arr::flatten($array);    
    $uniqueArray = array_unique($flatArray);
    out($out, $uniqueArray);
}

/**
 * @param  array         $array 
 * @param  callable      $out  
 * @return void       
 */
function flattenOut($out, $array) {
    $flatArray = Arr::flatten($array);    
    out($out, $flatArray);
}


// DOING SOME RETURNING, MAYBE THERE IS A BETTER WAY IF THE IDENTITIES ARE STATEFUL ?
///////////////////////////////////////

/**
 * @param  array         $array 
 * @return array       
 */
function flattenUnique($array) {
    $flatArray = Arr::flatten($array);    
    return $uniqueArray = array_unique($flatArray);
}
