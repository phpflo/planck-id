<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

class ScriptReplaceStrategy extends AbstractGraphStrategy implements GraphStrategy {
    use Traits\ReplaceScript;
    use Traits\ReplaceFlo;
    use Traits\ReplaceAfter;

    /**
     * {@inheritDoc}
     */
    public function configure(ExtendedFloGraph $graph) {
        $this->setupAddOriginals($graph);
        $this->setupReplace($graph);
        $this->setupReplaceAfter($graph);

        $this->setupReplaceScript($graph);

        $this->setupCallbacks($graph);
        return $graph;
    }
}