<?php

namespace PlanckId\Regex;

/**
 * used to be RegexInStringOut
 * 
 * @example 
 *      ...<script>var scriptBlockContents;</script>
 *      matches ['var scriptBlockContents;']
 *      return 'var scriptBlockContents;'
 *      
 * @example 
 *      ...<script>var scriptBlockContents;</script><script>var script2BlockContents;</script>...
 *      matches ['var scriptBlockContents;', 'var script2BlockContents;']
 *      return 'var scriptBlockContents;var script2BlockContents;'
 */
class JavaScriptRegex extends RegexInOut {
    protected $regex = '/(?<=\<script)(?:.*?\>)(.+?)(?=\<\/script\>)/s';
}