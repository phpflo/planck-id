<?php

namespace PlanckId\App;

use function setupNodes;
use PlanckId\Flo\ExtendedFloNetwork;
use PlanckId\Flo\ExtendedFloGraph;

class GraphBuilder {
    protected $graph;

    /**
     * @param  string $name
     * @return ExtendedFloGraph
     */
    public function build($name = 'planck', $type = 'mixed', $method = 'ExtractAndReplace') {
        $graph = $this->newGraph($name);
        $this->addEdges($graph);

        $strategy = $this->strategyFor($type, $method);
        $strategy->configure($graph);

        return $graph;
    }
    /**
     * could be a place for constraints
     * @param  string       $type
     * @param  string       $method
     * @return Strategy
     */
    public function strategyFor($type, $method) {
        if ($type == Planck::MARKUP || $type == Planck::MIXED) {
            $class = __NAMESPACE__ . '\Mixed'.$method.'Strategy';
            return new $class();
        }

        # [ ] EXTRACT_AND_REPLACE, REPLACE; $method == Planck::REPLACE
        if ($type == Planck::SCRIPT)
            return new ScriptReplaceStrategy();

        /**
         * Example
         *     - PlanckId\App\StyleExtractAndReplaceStrategy
         */
        if ($type == Planck::STYLE) {
            $class = __NAMESPACE__ . '\Style'.$method.'Strategy';
            return new $class();
        }
    }
    /**
     * @param  string $name
     * @return ExtendedFloGraph
     */
    public function newGraph($name) {
        return new ExtendedFloGraph($name);
    }
    /**
     * @return void
     */
    public function createGraph() {
        $this->setGraph(new ExtendedFloGraph('planck'));
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
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function addEdges(ExtendedFloGraph $graph) {
        setupNodes($graph);
    }
}