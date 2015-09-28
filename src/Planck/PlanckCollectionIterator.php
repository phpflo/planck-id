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
     * @return string
     */
    public function next() {
        $this->currentIndexPosition++;
        return $this->current();
    }
    /**
     * @return string
     */
    public function get($position = 0) {
        return $this->plancks[$position];
    }
    /**
     * @return string
     */
    public function current() {
        return $this->plancks[$this->currentIndexPosition];
    }
    /**
     * @return int
     */
    public function count() {
        return count($this->plancks);
    }
    /**
     * @return void
     */
    public function reset() {
        $this->currentIndexPosition = 0;
    }
}