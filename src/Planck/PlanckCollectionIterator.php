<?php

namespace PlanckId\Planck;

/**
 * was named MinifiedIdValuesIterator
 * 
 * standard array iterator
 */
class PlanckCollectionIterator {
    /**
     * @var array<string>
     */
    private $plancks; 

    /**
     * @var integer
     */
    private $currentIndexPosition = 0;

    /**
     * @param array $plancks 
     */
    public function __construct($plancks) {
        $this->plancks = $plancks;
    }

    /**
     * @return 
     */
    public function next() {
        $this->currentIndexPosition++;
        return $this->current();
    }

    public function get($position = 0) {
        return $this->plancks[$position];
    }

    /**
     * @return 
     */
    public function current() {
        return $this->plancks[$this->currentIndexPosition];
    }

    public function count() {
        return count($this->plancks);
    }

    public function reset() {
        $this->currentIndexPosition = 0;
    }
}