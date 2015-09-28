<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ReplaceAfter {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupReplaceAfter(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['ContentAndMap', 'out', 'ReadOriginalAndPlanckMap', 'in'],
            ['ReadOriginalAndPlanckMap', 'out', 'FloReplace', 'identities'],
        ));
    }
}
