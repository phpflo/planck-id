<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

interface GraphStrategy {
    /**
     * @param  ExtendedFloGraph $graph
     * @return ExtendedFloGraph
     */
    public function configure(ExtendedFloGraph $graph);
}