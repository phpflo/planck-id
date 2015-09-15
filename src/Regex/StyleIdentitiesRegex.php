<?php

namespace PlanckId\Regex;

/**
 * @example 
 *      pass in  ...#identity-selector{} .class-selector{} .class-selector#identity-selector{}...
 *      matches #`identity-selector` 
 *      returns array('identity-selector', 'identity-selector') because there are two, later the duplicates are removed
 */
class StyleIdentitiesRegex extends RegexInOut {
    protected $regex = '/(?<=\#)([a-zA-Z0-9\_\-]*)(?=[a-zA-Z0-9\#\{\s\.\,\>\^\<\[\(])/';
}