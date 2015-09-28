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
     * @param  Callable $mapOutput
     * @return void
     */
    function mapOut(Callable $mapOut) {
        $this->mapOut = $mapOut;
    }
    /**
     * @param  Callable $contentOut
     * @return void
     */
    function contentOut(Callable $contentOut) {
        $this->contentOut = $contentOut;
    }

    /**
     * @param  string $contentIn
     * @return void
     */
    function contentIn($contentIn) {
        $this->contentIn = $contentIn;
    }
    /**
     * @param  json|array $mapIn
     * @return void
     */
    function mapIn($mapIn) {
        $this->mapIn = $mapIn;
    }
    /**
     * @param  string $contentType (enum|constant)
     * @return void
     */
    function setContentType($contentType) {
        $this->contentType = $contentType;
    }
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    function setGraph(ExtendedFloGraph $graph) {
        $this->graph = $graph;
    }
    /**
     * @return ExtendedFloGraph
     */
    function getGraph() {
        return $this->graph;
    }
    /**
     * @return string
     */
    function getContentType() {
        return $this->contentType;
    }    
    /**
     * @return string
     */
    function getMapOut() {
        return $this->mapOut;
    }    
    /**
     * @return string
     */
    function getMapIn() {
        return $this->mapIn;
    }    
    /**
     * @return string
     */
    function getContentIn() {
        return $this->contentIn;
    }    
    /**
     * @return string
     */
    function getContentOut() {
        return $this->contentOut;
    }
}
