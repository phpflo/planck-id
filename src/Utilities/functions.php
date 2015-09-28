<?php

use Illuminate\Support\Arr;

###########################################
# Utilities
###########################################

function lineOut($content) {
    if (defined('DEBUGGING_PLANCK') && true === DEBUGGING_PLANCK) {
        echo PHP_EOL . PHP_EOL;
        dump($content);
        echo PHP_EOL . PHP_EOL;
    }
}
function alwaysOutput($content) {
    dump($content);
}
function enableDebugging() {
    if (!defined('DEBUGGING_PLANCK'))
        define('DEBUGGING_PLANCK', true);
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
 * @param  array $array
 * @return bool
 */
function isMultiDimensionalArray($array) {
    foreach ($array as $value)
        if (is_array($value))
            return true;

    return false;
}

/**
 * @example
 *     input   "dddasdfdddasdffff", "asdf"
 *     return
 *
 * @param  string $haystack
 * @param  string $needle
 * @return array<int>
 */
function substringAll($haystack, $needle) {
    $lastPos = 0;
    $positions = array();

    while (($lastPos = strpos($haystack, $needle, $lastPos))!== false) {
        $positions[] = $lastPos;
        $lastPos = $lastPos + strlen($needle);
    }

    return $positions;
}
function containsAnySubStrings($haystack, array $needles) {
    foreach ($needles as $needle)
        if (false !== strpos($haystack, $needle))
            return true;
    return false;
}
function containsAllSubStrings($haystack, array $needles) {
    foreach ($needles as $needle)
        if (false === strpos($haystack, $needle))
            return false;
    return true;
}
function containsSubString($haystack, $needle) {
    return false !== strpos($haystack, $needle);
}
function doesNotContainSubString($haystack, $needle) {
    return false === strpos($haystack, $needle);
}
function doesNotContainAnySubString($haystack, array $needles) {
    foreach ($needles as $needle)
        if (containsSubString($haystack, $needle))
            return false;

    return true;
}
function allEqual($value, array $array) {
    foreach ($array as $item)
        if ($value !== $item)
            return false;

    return true;
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
 * Convenience method for one line preg match
 *
 * @param  string $x
 * @param  string $regex
 * @return array
 */
function pregMatchAll($x, $regex) {
    preg_match_all($regex, $x, $matches);
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