<?php

namespace PlanckId\Planck;

/**
 * was IdentityRegistry
 * could be done another way 
 */
class OriginalAndPlanckMap {
    public static $newIdentities = [];

    public static function has($originalIdentity) { 
        return isset(self::$newIdentities[$originalIdentity]);
    }

    public static function set($key, $value) {
        self::$newIdentities[$key] = $value; 
    }

    public static function sortByLength() {
        self::$newIdentities = sortByKeyLength(self::$newIdentities);        
    }

    public static function reset() {
        self::$newIdentities = []; 
    }
}