<?php

/**
 * @example
 *      datain: `githubIconButtons = $('.icon-github');`
 *      regexpiece: `icon-github`
 *      matches ['icon-github']
 */
class JavaScriptSelectorRegex extends RegexInOut {
    protected $regex = '/(?<=\"|\')(?:.*?)('.$this->regexPiece.')(?:.*?)(?=\"|\')/s';
}
