<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

class StyleExtractAndReplaceStrategy extends AbstractGraphStrategy implements GraphStrategy {
    use Traits\ReplaceStyle;
    use Traits\ReplaceFlo;
    use Traits\ExtractAndReplaceFlo;    
    use Traits\ExtractStyle;

    /**
     * {@inheritDoc}
     */
    public function configure(ExtendedFloGraph $graph) {
        $this->setupAddOriginals($graph);
        $this->setupExtractAndReplace($graph);

        $this->setupExtractStyle($graph);
        $this->setupReplaceStyle($graph);

        $this->setupCallbacks($graph);
        return $graph;
    }
}