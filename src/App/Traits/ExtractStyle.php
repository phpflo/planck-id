<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ExtractStyle {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupExtractStyle(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['ExtractOriginals', 'style', 'Style', 'in'],
            #Style
                ['Style', 'styleblocks', 'StyleRegexRepeater', 'styleblocks'],

                ['StyleRegexRepeater', 'identities', 'StyleIdentitiesRegex_Match', 'in'],
                  ['StyleIdentitiesRegex_Match', 'out', 'AddOriginals', 'in'],

                ['StyleRegexRepeater', 'classes', 'StyleClassesRegex_Match', 'in'],
                  ['StyleClassesRegex_Match', 'out', 'AddOriginals', 'in'],
        ));
    }
}