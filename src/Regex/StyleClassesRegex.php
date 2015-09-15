<?php

namespace PlanckId\Regex;

/**
 * @example 
 *      pass in  ...#identity-selector{} .class-selector{} .class-selector#identity-selector{}...
 *      matches .`class-selector` 
 *      returns array('class-selector', 'class-selector') because there are two, later the duplicates are removed
 */
class StyleClassesRegex extends RegexInOut {
    protected $regex = '/(?<=\.)([a-zA-Z0-9\_\-]*)(?=[a-zA-Z0-9\#\{\s\.\,\>\^\<\[\(])/s';
}