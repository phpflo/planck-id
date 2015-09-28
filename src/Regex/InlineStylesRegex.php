<?php

namespace PlanckId\Regex;

/**
 * find styles that are inline html
 *
 * @example
 *  pass in   <p style=".selector{display:block;}">...</p>
 *  returns   .selector{display:block}
 */
class InlineStylesRegex extends RegexInOut {
    protected $regex = '/(?<=style\=\")(.+?)(?=\")/s';
}
class InlineStylesStringRegex extends RegexInStringOut {
    protected $regex = '/(?<=style\=\")(.+?)(?=\")/s';
}