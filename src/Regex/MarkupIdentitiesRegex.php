<?php

namespace PlanckId\Regex;

/**
 * @example
 *    pass in    <p id="a-long_selector-2">...</p>
 *    get back   a-long_selector-2
 */
class MarkupIdentitiesRegex extends RegexInOut {
    protected $regex = '/(?<=id\=\")[a-zA-Z0-9\_\-]+(?=\")/';
}
