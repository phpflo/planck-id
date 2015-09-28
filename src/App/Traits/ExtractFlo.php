<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ExtractFlo {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupExtract(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['ContentAndMap', 'content', 'WriteContent', 'in'],
              ['WriteContent', 'out', 'ReadContent', 'in'],
                ['ReadContent', 'out', 'ExtractOriginals', 'in'],
        ));
    }
}