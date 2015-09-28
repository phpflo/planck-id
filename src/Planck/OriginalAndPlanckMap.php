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
    /**
     * @param  string $original
     * @return boolean
     */
    public static function has($original) {
        return isset(self::$map[$original]);
    }
    /**
     * @param  string $planck
     * @return boolean
     */
    public static function hasPlanck($planck) {
        return in_array($planck, self::$map);
    }    
    /**
     * @param  string $key
     * @param  string $value
     * @return boolean
     */
    public static function set($key, $value) {
        self::$map[$key] = $value;
    }
    /**
     * @return void
     */
    public static function sortByLength() {
        self::$map = sortByKeyLength(self::$map);
    }
    /**
     * @return void
     */
    public static function reset() {
        self::$map = [];
    }
}
