<?php

namespace PlanckId\Regex;

/**
 * An extension to RegexInOut to take the result and make it a string (if it is an array)
 */
class RegexInStringOut extends RegexInOut
{
    protected function get($data) {
        $matches = parent::get($data);
        if (is_array($data))
            $matches = implode("", $matches);

        return $matches;
    }
}