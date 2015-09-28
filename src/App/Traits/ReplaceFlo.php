<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ReplaceFlo {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupReplace(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['ContentAndMap', 'content', 'WriteContent', 'in'],
              ['WriteContent', 'out', 'ReadContent', 'in'],
                ['ReadContent', 'out', 'FloReplace', 'content'],
        ));
    }
}
