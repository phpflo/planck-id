<?php

namespace PlanckId;

use FeatureContext;

class ExtractionTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractingOriginalsWithoutContext()
    {
        $test9 = new FeatureContext([]);
        $test9->iHaveContent("element.classOriginal#idee[attr='eh']");
        $test9->iExtractOriginalsWithoutContext();
        $test9->iShouldGet('classOriginal,idee');
    }
}