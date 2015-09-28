<?php

namespace PlanckId\Regex;

/**
 * @example
 *    @see extractClassContents()::@return
 *    pass in `a-long_selector-2 {$sr45()E@# someOtherSelector ad1ffSelector`
 *    returns array(a-long_selector-2, someOtherSelector, ad1ffSelector)
 */
class MarkupClassesFromMatchedRegex extends RegexInOut {
    protected $regex = '/([a-zA-Z0-9\_\-]*)/';
}
