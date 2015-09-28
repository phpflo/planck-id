<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloNetwork;
use PlanckId\Flo\ExtendedFloGraph;

abstract class AbstractGraphStrategy {
    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupCallbacks(ExtendedFloGraph $graph) {
        $graph->addEdges([
            ['ContentAndMap', 'map', 'WriteOriginalAndPlanckMap', 'in'],

            ['ContentAndMap', 'out', 'ReadContent_ForContentAndMap', 'in'],
                ['ReadContent_ForContentAndMap', 'out', 'Callback_ForContent', 'in'],
            ['ContentAndMap', 'out', 'ReadOriginalAndPlanckMap_ForOutput', 'in'],
                ['ReadOriginalAndPlanckMap_ForOutput', 'out', 'Callback_ForMap', 'in'],

            ['OriginalsToPlancks', 'out', 'DisplayOutputForTesting', 'in'],
        ]);
    }

    /**
     * @param ExtendedFloGraph $graph
     * @return void
     */
    public function setupAddOriginals(ExtendedFloGraph $graph) {
        $graph->addEdges(array(
            ['AddOriginals', 'out', 'RemoveUselessOriginals', 'in'],
            ['RemoveUselessOriginals', 'out', 'SortOriginalsByLength', 'in'],
            ['SortOriginalsByLength', 'out', 'OriginalsToPlancks', 'in'],
        ));
    }
}