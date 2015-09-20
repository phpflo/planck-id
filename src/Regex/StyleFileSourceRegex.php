<?php

namespace PlanckId\Regex;

/**
 * @example 
 *      ...<link href="//example.com/styles.css">...
 *      return '//example.com/styles.js'
 *      
 * @example 
 *      ...<link href="//example.com/styles.css"><link href="//example.com/styles.min.css">...
 *      return ['//example.com/styles.js', '//example.com/styles.min.js']
 */
class StyleFileSourceRegex extends RegexInOut {
    protected $regex = '/(?<=\<link)(?:.*?)(?:href\=\"?)(.*?)(?=\")/s';
}