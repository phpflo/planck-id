<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

class StyleExtractStrategy extends AbstractGraphStrategy implements GraphStrategy {
    use Traits\ExtractFlo;
    use Traits\ExtractStyle;
    
    /**
     * {@inheritDoc}
     */
    public function configure(ExtendedFloGraph $graph) {
        $this->setupAddOriginals($graph);
        $this->setupExtract($graph);

        $this->setupExtractStyle($graph);

        $this->setupCallbacks($graph);
        return $graph;
    }
}