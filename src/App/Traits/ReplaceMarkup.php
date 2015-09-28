<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ReplaceMarkup {
    public function setupReplaceMarkup(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['FloReplace', 'contentout', 'ReplaceMarkupIdentities', 'content'],
            ['FloReplace', 'identitiesout', 'ReplaceMarkupIdentities', 'identities'],

            ['FloReplace', 'contentout', 'ReplaceMarkupClasses', 'content'],
            ['FloReplace', 'identitiesout', 'ReplaceMarkupClasses', 'identities'],
        ));
    }
}
