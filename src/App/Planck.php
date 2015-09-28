<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;
use PlanckId\Flo\ExtendedFloNetwork;

class Planck {
    const EXTRACT = 'Extract';
    const REPLACE = 'Replace';
    const EXTRACT_AND_REPLACE = 'ExtractAndReplace';
    const MIXED = 'mixed';
    const SCRIPT = 'script';
    const MARKUP = 'markup';
    const STYLE = 'style';

    protected $graph;
    protected $mapOut;
    protected $mapIn;
    protected $contentIn;
    protected $contentOut;
    protected $contentType;

    public function __construct(ExtendedFloGraph $graph) {
        $this->setGraph($graph);
    }

    /**
     * @param  callable $mapOutput
     * @return void
     */
    public function mapOut(callable $mapOut) {
        $this->mapOut = $mapOut;
    }
    /**
     * @param  callable $contentOut
     * @return void
     */
    public function contentOut(callable $contentOut) {
        $this->contentOut = $contentOut;
    }

    /**
     * @param  string $contentIn
     * @return void
     */
    public function contentIn($contentIn) {
        $this->contentIn = $contentIn;
    }
    /**
     * @param  json|array $mapIn
     * @return void
     */
    public function mapIn($mapIn) {
        $this->mapIn = $mapIn;
    }
    /**
     * @param  string $contentType (enum|constant)
     * @return void
     */
    public function setContentType($contentType) {
        $this->contentType = $contentType;
    }
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setGraph(ExtendedFloGraph $graph) {
        $this->graph = $graph;
    }
    /**
     * @return ExtendedFloGraph
     */
    public function getGraph() {
        return $this->graph;
    }
    /**
     * @return string
     */
    public function getContentType() {
        return $this->contentType;
    }    
    /**
     * @return string
     */
    public function getMapOut() {
        return $this->mapOut;
    }    
    /**
     * @return string
     */
    public function getMapIn() {
        return $this->mapIn;
    }    
    /**
     * @return string
     */
    public function getContentIn() {
        return $this->contentIn;
    }    
    /**
     * @return string
     */
    public function getContentOut() {
        return $this->contentOut;
    }
}
