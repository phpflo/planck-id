<?php

namespace PlanckId\Regex;

/**
 * [ ] @TODO: must make this work for not matching
 * @example
 *    - 
 */
class PhpBlocksRegex extends RegexInOut {
    protected $regex = '/(\?<=\<\?=|php)(.*?)(?=\?\>)/s';
}
