<?php

namespace PlanckId\Regex;

/**
 * @example 
 *    pass in   <p class="a-long_selector-2 someOtherSelector ad1ffSelector">...</p>
 *    get back  a-long_selector-2 someOtherSelector ad1ffSelector
 */
class MarkupClassesRegex extends RegexInOut {
    protected $regex = '/(?<=class\=\")([a-zA-Z0-9\_\-\s]+?)(?=\")/s';
}   