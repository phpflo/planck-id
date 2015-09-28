<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

class MarkupExtractStrategy extends AbstractGraphStrategy implements GraphStrategy {
    use Traits\ExtractMarkup;
    use Traits\ExtractFlo;

    /**
     * {@inheritDoc}
     */
    public function configure(ExtendedFloGraph $graph) {
        $this->setupAddOriginals($graph);
        $this->setupExtract($graph);
        $this->setupExtractMarkup($graph);
        $this->setupCallbacks($graph);
        return $graph;
    }
}