<?php

namespace PlanckId\Flo;

use PhpFlo\Graph;

class ExtendedFloGraph extends Graph {
    /**
     * [ ] if !multidimensionalArray, then addEdges
     * @param  array $edges<array>
     * @return void
     */
    function addEdges($edges) {
        foreach ($edges as $edge) {
            if (isMultiDimensionalArray($edge)) {
                $this->addEdges($edge);
                continue;
            }

            $this->addEdge($edge[0], $edge[1], $edge[2], $edge[3]);
        }
    }
}
