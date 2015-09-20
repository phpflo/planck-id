<?php

namespace PlanckId\Planck;

/**
 * was IdentityRegistry
 * had $newIdentities
 * 
 * could be done another way 
 */
class OriginalAndPlanckMap {
    /**
     * @var array<string#original, string#planck>
     */
    public static $map = [];

    public static function has($original) { 
        return isset(self::$map[$original]);
    }

    public static function set($key, $value) {
        self::$map[$key] = $value; 
    }

    public static function sortByLength() {
        self::$map = sortByKeyLength(self::$map);        
    }

    public static function reset() {
        self::$map = []; 
    }
}