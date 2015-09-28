<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

class MixedExtractStrategy extends AbstractGraphStrategy implements GraphStrategy {
    use Traits\ExtractFlo;
    use Traits\ExtractMarkup;
    use Traits\ExtractStyleBlocks;
    use Traits\ReplaceStyleBlocks;
    use Traits\ReplaceScriptBlocks;

    /**
     * {@inheritDoc}
     */
    public function configure(ExtendedFloGraph $graph) {
        $this->setupAddOriginals($graph);
        $this->setupExtract($graph);

        $this->setupExtractStyle($graph);
        $this->setupExtractMarkup($graph);

        $this->setupCallbacks($graph);
        return $graph;
    }
}