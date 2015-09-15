<?php

namespace PlanckId\Regex;

/**
 * @example 
 *      ...<script src="//example.com/scripts.js"></script>...
 *      return '//example.com/scripts.js'
 *      
 * @example 
 *      ...<script src="//example.com/scripts.js"></script><script src="//example.com/scripts.min.js"></script>...
 *      return ['//example.com/scripts.js', '//example.com/scripts.min.js']
 */
class JavaScriptFileSourceRegex extends RegexInOut {
    protected $regex = '/(?<=\<script)(src\".\")(?=\<\/script\>)/s';
}