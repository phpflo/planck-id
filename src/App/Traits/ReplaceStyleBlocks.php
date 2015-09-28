<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ReplaceStyleBlocks {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupReplaceStyle(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ["FloReplace", "identitiesout", "ReplaceStyleSelectors", "identities"],
            ["FloReplace", "contentout", "ReplaceStyleBlockStyles", "in"],
                ["ReplaceStyleBlockStyles", "regex", "StyleBlocksRegex_Replace", "in"],
                  ["StyleBlocksRegex_Replace", "out", "ReplaceStyleSelectors", "match"],

                ["ReplaceStyleBlockStyles", "content", "DisplayOutputForTesting", "in"],
                  ["ReadContent_ForStyleBlocks", "out", "ReplaceStyleSelectors", "content"],
        ));
    }
}
