<?php

namespace PlanckId;

use FeatureContext;

class OriginalsToPlanckTest extends \PHPUnit_Framework_TestCase {
    public function testSingle() {
        $test7 = new FeatureContext([]);
        $test7->iHaveContent('#idee');
        $test7->iTurnOriginalIntoPlanck();
        $test7->iShouldGet('a');
        $test7->assertOutput();
    }
    public function testMultiple() {
        $test8 = new FeatureContext([]);
        $test8->iHaveContent('#idee,.classy,identifier');
        $test8->iTurnOriginalsIntoPlancks();
        $test8->iShouldGet('a,b,c');
        $test8->assertOutput();
    }
}
