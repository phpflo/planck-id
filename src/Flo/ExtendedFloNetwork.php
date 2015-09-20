<?php

namespace PlanckId\Flo;

use PhpFlo\Network;

class ExtendedFloNetwork extends Network {
    public function addNode(array $node)
    {
        if (isset($this->processes[$node['id']])) {
            return;
        }

        $process = array();
        $process['id'] = $node['id'];

        if (isset($node['component'])) {
            $componentClass = $node['component'];
            if (!class_exists($componentClass) && strpos($componentClass, '\\') === false) {
                $componentClass = "PhpFlo\\Component\\{$componentClass}";
                if (!class_exists($componentClass)) {
                    throw new \InvalidArgumentException("Component class {$componentClass} not found");
                }
            }

            // [ ] DIC HERE
            $component = new $componentClass();
            if (!$component instanceof ComponentInterface) {
                throw new \InvalidArgumentException("Component {$node['component']} doesn't appear to be a valid PhpFlo component");
            }
            $process['component'] = new $componentClass();
        }

        $this->processes[$node['id']] = $process;
    }
}