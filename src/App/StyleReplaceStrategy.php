<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

class StyleReplaceStrategy extends AbstractGraphStrategy implements GraphStrategy {
    use Traits\ReplaceStyle;
    use Traits\ReplaceFlo;
    use Traits\ReplaceAfter;

    /**
     * {@inheritDoc}
     */
    public function configure(ExtendedFloGraph $graph) {
        $this->setupAddOriginals($graph);
        $this->setupReplace($graph);
        $this->setupReplaceAfter($graph);

        $this->setupReplaceStyle($graph);

        $this->setupCallbacks($graph);
        return $graph;
    }
}