<?php

namespace PlanckId\App;

class PlanckFactory {
    public function create($name = 'planck', $type = 'mixed', $method = 'ExtractAndReplace') {
        $graphBuilder = new GraphBuilder();
        $graph = $graphBuilder->build($name, $type, $method);
        return new Planck($graph);
    }
}