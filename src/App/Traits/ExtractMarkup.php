<?php

namespace PlanckId\App\Traits;

use PlanckId\Flo\ExtendedFloGraph;

trait ExtractMarkup {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupExtractMarkup(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['ExtractOriginals', 'markup', 'Markup', 'in'],
            #Markup
                ['Markup', 'identities', 'MarkupIdentitiesRegex', 'in'],
                  ['MarkupIdentitiesRegex', 'out', 'AddOriginals', 'in'],

                ['Markup', 'classes', 'MarkupClassesRegex', 'in'],
                    ['MarkupClassesRegex', 'out', 'MarkupClassesFromMatchedRegex', 'in'],
                      ['MarkupClassesFromMatchedRegex', 'out', 'AddOriginals', 'in'],
        ));
    }
}
