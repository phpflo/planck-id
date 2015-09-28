<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ReplaceScriptBlocks {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupReplaceScript(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['FloReplace', 'contentout', 'ReplaceJavaScriptBlocks', 'in'],
                ['ReplaceJavaScriptBlocks', 'content', 'ReadContent_ForJavaScriptBlocks', 'in'],
                  ['ReadContent_ForJavaScriptBlocks', 'out', 'ReplaceJavaScript', 'content'],

                ['ReplaceJavaScriptBlocks', 'regex', 'JavaScriptRegex_Replace', 'in'],
                ['JavaScriptRegex_Replace', 'out', 'ReplaceJavaScript', 'match'],
            ['FloReplace', 'identitiesout', 'ReplaceJavaScript', 'identities'],
        ));
    }
}
