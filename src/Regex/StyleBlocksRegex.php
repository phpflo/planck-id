<?php

namespace PlanckId\Regex;

/**
 * find styles that are inside <style> blocks
 *
 * @example
 *    pass in   <!DOCTYPE html><title>...</title><style>.selector{property:value}</style><p>tags</p><style>#identity{color:#000;}</style>
 *    returns   .selector{property:value} #identity{color:#000;}
 */
class StyleBlocksRegex extends RegexInOut {
    protected $regex = '/(?:\<style.*?\>)(.+?)(?=\<\/style\>)/s';
}
