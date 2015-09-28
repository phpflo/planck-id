<?php

namespace PlanckId\App;

use PlanckId\Flo\ExtendedFloGraph;

class MixedExtractAndReplaceStrategy extends AbstractGraphStrategy implements GraphStrategy {
    use Traits\ExtractMarkup;
    use Traits\ReplaceMarkup;
    use Traits\ReplaceAfter;
    use Traits\ExtractStyleBlocks;
    use Traits\ReplaceStyleBlocks;
    use Traits\ReplaceScriptBlocks;
    use Traits\ExtractAndReplaceFlo;

    /**
     * {@inheritDoc}
     */
    public function configure(ExtendedFloGraph $graph) {
        $this->setupAddOriginals($graph);
        $this->setupExtractAndReplace($graph);
        $this->setupReplaceAfter($graph);

        $this->setupExtractStyle($graph);
        $this->setupExtractMarkup($graph);

        $this->setupReplaceMarkup($graph);
        $this->setupReplaceStyle($graph);
        $this->setupReplaceScript($graph);

        $this->setupCallbacks($graph);
        return $graph;
    }
}