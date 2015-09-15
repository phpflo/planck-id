<?php

namespace PlanckId;

use League\Event\Emitter as EventEmitter;
use League\Event\Event;

/**
 *  [ ] if needed, 
 *      could also have an array of $emitters and when ::emitt-ing, pass another @param on which to ::emit on
 *      /** @var array<Emitter> * / private static $emitters = []; 
 */
class Emitter {
    private static $emitter;

    /**
     * this constructor function is so the `emitter` function is not the automatically a static constructor
     */
    public function __construct() {}

    /**
     * @return League\Event\Emitter
     */
    public static function emitter() {  
        self::default();      
        return self::$emitter;
    }
    public static function setEmitter($emitter) {        
        self::$emitter = $emitter;
    }
    public static function default() {
        if (self::$emitter === null)    
            self::setEmitter(new EventEmitter);
    }    
    public static function addListener($event, $listener, $priority = EventEmitter::P_NORMAL) {
        return self::emitter()->addListener($event, $listener, $priority);
    }
    public static function emit($event, $param = null) {
        return self::emitter()->emit($event, $param);
    }
    public static function emitEventNamed($eventName) {
        return self::emitter()->emit(Event::named($eventName));
    }
}

