<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ReplaceStyle {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupReplaceStyle(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['FloReplace', 'identitiesout', 'ReplaceStyleSelectors', 'identities'],
            ['FloReplace', 'contentout', 'ReplaceStyleSelectors', 'match'],
            ['FloReplace', 'contentout', 'ReplaceStyleSelectors', 'content'],
        ));
    }
}
