<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;
use PlanckId\Flo\ExtendedFloNetwork;

/**
 * [ ] DI *** 
 */
class NetworkFactory {
    public function createFromPlanck(Planck $planck) {
        return $this->create($planck->getGraph(), $planck);
    }

    public function create(ExtendedFloGraph $graph, Planck $planck) {
        $graph->addInitial($planck->getMapOut(), 'Callback_ForMap', 'callback');
        $graph->addInitial($planck->getContentOut(), 'Callback_ForContent', 'callback');

        if (is_array($planck->getMapIn()))
            $graph->addInitial($planck->getMapIn(),  'ContentAndMap', 'map');
       
        $graph->addInitial($planck->getContentIn(),  'ContentAndMap', 'content');

        $graph->addInitial('not sure about this... what should replace it?', 'ContentAndMap', 'last');
 
        return $this->createNetwork($graph);
    }    

    /**
     * Make the graph 'live'
     * @param ExtendedFloGraph $graph
     * @return Network
     */
    public function createNetwork(ExtendedFloGraph $graph) {
        return ExtendedFloNetwork::create($graph);
    }
}