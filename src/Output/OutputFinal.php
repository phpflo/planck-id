<?php

namespace PlanckId\Output;

use PlanckId\Flo\FloComponent;

class OutputFinal extends FloComponent
{    
    protected $originalContent;
    protected $planckedContent;
    protected $map;

    public function __construct() {
        $this->addPorts([['in', 'map'], ['in', 'planckedcontent'], ['in', 'originalcontent']]);
        $this->inPorts['map']->on('data', [$this, 'map']);
        $this->inPorts['originalcontent']->on('data', [$this, 'original']);
        $this->inPorts['planckedcontent']->on('data', [$this, 'plancked']);
        $this->inPorts['planckedcontent']->on('disconnect', [$this, 'output']);
    }

    /**
     * @param  OriginalToPlanckMap  $data
     * @return void
     */
    public function map($data) {
        $this->map = $data;
    }

    /**
     * @param  string  $data
     * @return void
     */
    public function original($data) {
        $this->originalContent = $data;
    }
    
    /**
     * @param  string  $data
     * @return void
     */
    public function plancked($data) {        
        $this->planckedContent = $data;
    }

    /**
     * @param  mixed  $data
     * @return void
     */
    public function output($data) {
        echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";
        echo "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
        echo "<hr><hr><hr>";
        lineOut(__METHOD__);
        echo "<h1>Original to Planck map</h1>";
        lineOut($this->map);        

        echo "<h1>Original content</h1>";
        lineOut($this->originalContent);

        echo "<h1>Plancked content</h1>";
        lineOut($this->planckedContent);
    }
}