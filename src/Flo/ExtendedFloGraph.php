<?php

namespace PlanckId\Flo;

use PhpFlo\Graph;

/**
 * had to copy everything here since $name was private
 */
class ExtendedFloGraph extends Graph {
    protected $name = "";

    /**
     * @return json - the json encoded graph
     */
    public function toJSON() {
        $json = array(
            'properties' => array(
                'name' => $this->name,
            ),
            'processes' => array(),
            'connections' => array(),
        );

        foreach ($this->nodes as $node) {
            $json['processes'][$node['id']] = array(
                'component' => $node['component'],
            );
        }

        foreach ($this->edges as $edge) {
            $json['connections'][] = array(
                'src' => array(
                    'process' => $edge['from']['node'],
                    'port' => $edge['from']['port'],
                ),
                'tgt' => array(
                    'process' => $edge['to']['node'],
                    'port' => $edge['to']['port'],
                ),
            );
        }

        foreach ($this->initializers as $initializer) {
            $json['connections'][] = array(
                'data' => $initializer['from']['data'],
                'tgt' => array(
                    'process' => $initializer['to']['node'],
                    'port' => $initializer['to']['port'],
                ),
            );
        }

        return json_encode($json, JSON_PRETTY_PRINT);
    }

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
