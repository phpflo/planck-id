<?php

namespace PlanckId;

use FeatureContext;

class ExtractStyleClassesTest extends \PHPUnit_Framework_TestCase
{
    public function testStyleClassesExtraction()
    {
        $test3 = new FeatureContext([]);
        $test3->iHaveContent("element.selector#idee[attr='eh']");
        $test3->iExtractStyleClasses();
        $test3->iShouldGet("selector");
    }    

    public function testStyleIdentitiesExtraction()
    {
        $test4 = new FeatureContext([]);
        $test4->iHaveContent("element.selector#idee[attr='eh']");
        $test4->iExtractStyleIdentities();
        $test4->iShouldGet("idee");
    }

    public function testStyleBlocksStyleExtraction()
    {
        $test5 = new FeatureContext([]);
        $test5->iHaveContent('
          <style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {
          text-shadow:0 1px 0 rgba(22, 24, 29, 0.5);
          }</style><style type="text/css" scoped="scoped">@media (max-width: 399px) {
          #post-simple-media-adjacent-left-8-media {}}
          @media (min-width: 400px) and (max-width: 589px) {#post-simple-media-adjacent-left-8-media {}}@media (min-width: 590px) {#post-simple-media-adjacent-left-8-media {}<section id="section-acebf433-a6ec-43f6-8166-55c8d129353a" class="post-simple media-adjacent left else" style="background-color:rgb(45, 49, 57); position:relative"><style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a { </style>
        ');
        $test5->iExtractSelectorsFromStyleBlocks();
        $test5->iShouldGet("section-acebf433-a6ec-43f6-8166-55c8d129353a,post-simple-media-adjacent-left-8-media");
    }
}