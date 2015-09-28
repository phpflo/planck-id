<?php

namespace PlanckId;

use FeatureContext;

class ExtractAndMinifyFromFileTest extends \PHPUnit_Framework_TestCase {
    public function testExtractAndMinifyFromFile() {
        $test6 = new FeatureContext([]);
        $test6->iHaveAFileNamed(__DIR__.'/files/scenario-input.html');
        $test6->iHaveInputFromFile(__DIR__.'/files/scenario-input.html');
        $test6->thatGoesIntoAFileNamed(__DIR__.'/files/scenario-input.html');
        $test6->iExtractAndMinify();
        $test6->iWriteOutputToAFileNamed(__DIR__.'/files/scenario-output.html');
        $test6->iShouldGetTheSameOutputAsTheContentsOfTheFile(__DIR__.'/files/scenario-output.html');
        $test6->assertOutput();    
    }    
}
