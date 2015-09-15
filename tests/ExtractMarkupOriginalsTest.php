<?php

namespace PlanckId;

use FeatureContext;

class ExtractMarkupClassesTest extends \PHPUnit_Framework_TestCase
{
    public function testMarkupClassExtraction()
    {
        $test1 = new FeatureContext([]);
        $test1->iHaveContent('<a href="sdfsf" id="mu_idee" class="eh">link</a><p id="wtf"></p>');
        $test1->iExtractMarkupClasses();
        $test1->iShouldGet("eh");
    }    

    public function testMarkupIdentitiesExtraction()
    {
        $test2 = new FeatureContext([]);
        $test2->iHaveContent('<a href="sdfsf" id="mu_idee" class="eh">link</a><p id="wtf"></p>');
        $test2->iExtractMarkupIdentification();
        $test2->iShouldGet("mu_idee,wtf");
    }
}