<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

class MarkupExtractAndReplaceStrategy extends AbstractGraphStrategy implements GraphStrategy {
    use Traits\ExtractMarkup;
    use Traits\ReplaceMarkup;
    use Traits\ReplaceAfter;
    use Traits\ExtractAndReplaceFlo;

    /**
     * {@inheritDoc}
     */
    public function configure(ExtendedFloGraph $graph) {
        $this->setupAddOriginals($graph);
        $this->setupExtractAndReplace($graph);
        $this->setupReplaceAfter($graph);

        $this->setupExtractMarkup($graph);
        $this->setupCallbacks($graph);
        return $graph;
    }
}