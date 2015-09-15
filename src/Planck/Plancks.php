<?php

namespace PlanckId\Planck;

class Plancks {
    public static $planckIterator = null;
    public static function planckIterator() {
        if (self::$planckIterator === null) 
            self::$planckIterator = PlanckCollectionBuilder::built();
       
        return self::$planckIterator;
    }
    public static function next() {
        $current = self::planckIterator()->current();
        self::planckIterator()->next();
        return $current;
    }
    public static function reset() {
        self::$planckIterator = PlanckCollectionBuilder::built();
    }
}