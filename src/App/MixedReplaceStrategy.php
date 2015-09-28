<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

class MixedReplaceStrategy extends AbstractGraphStrategy implements GraphStrategy {
    use Traits\ReplaceMarkup;
    use Traits\ReplaceAfter;
    use Traits\ReplaceStyleBlocks;
    use Traits\ReplaceScriptBlocks;
    use Traits\ReplaceFlo;

    /**
     * {@inheritDoc}
     */
    public function configure(ExtendedFloGraph $graph) {
        $this->setupAddOriginals($graph);
        $this->setupReplace($graph);

        $this->setupExtractStyle($graph);
        $this->setupExtractMarkup($graph);

        $this->setupReplaceMarkup($graph);
        $this->setupReplaceStyle($graph);
        $this->setupReplaceScript($graph);

        $this->setupCallbacks($graph);
        return $graph;
    }
}        
