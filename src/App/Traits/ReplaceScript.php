<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ReplaceScript {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupReplaceScript(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['FloReplace', 'identitiesout', 'ReplaceJavaScript', 'identities'],
            ['FloReplace', 'contentout', 'ReplaceJavaScript', 'match'],
        ));
    }
}
