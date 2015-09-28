<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

class MarkupReplaceStrategy extends AbstractGraphStrategy implements GraphStrategy {
    use Traits\ReplaceMarkup;
    use Traits\ReplaceAfter;
    use Traits\ReplaceFlo;

    /**
     * {@inheritDoc}
     */
    public function configure(ExtendedFloGraph $graph) {
        $this->setupAddOriginals($graph);
        $this->setupReplace($graph);
        $this->setupReplaceMarkup($graph);
        $this->setupCallbacks($graph);
        return $graph;
    }
}