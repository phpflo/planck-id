<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ExtractAndReplaceFlo {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupExtractAndReplace(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['ContentAndMap', 'content', 'WriteContent', 'in'],
              ['WriteContent', 'out', 'ReadContent', 'in'],
                ['ReadContent', 'out', 'ExtractOriginals', 'in'],
                ['ReadContent', 'out', 'FloReplace', 'content'],
        ));
    }
}
