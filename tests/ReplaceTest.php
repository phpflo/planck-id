<?php

namespace PlanckId;

use FeatureContext;

class ReplaceTest extends \PHPUnit_Framework_TestCase {
    public function testReplacingUsingExistingMap() {
        $test11 = new FeatureContext([]);
        $test11->iHaveContent('
          <style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {
          text-shadow:0 1px 0 rgba(22, 24, 29, 0.5);
          }</style><style type="text/css" scoped="scoped">@media (max-width: 399px) {
          #post-simple-media-adjacent-left-8-media {}}
          @media (min-width: 400px) and (max-width: 589px) {#post-simple-media-adjacent-left-8-media {}}@media (min-width: 590px) {#post-simple-media-adjacent-left-8-media {}<section id="section-acebf433-a6ec-43f6-8166-55c8d129353a" class="post-simple media-adjacent left else" style="background-color:rgb(45, 49, 57); position:relative"><style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a { </style>
        ');
        $test11->replaceUsingExistingMap();
        $test11->assertOutput();
    }

    public function testMarkupIdentitiesExtraction() {
        $test2 = new FeatureContext([]);
        $test2->iHaveContent('<a href="sdfsf" id="mu_idee" class="eh">link</a><p id="wtf"></p>');
        $test2->iExtractMarkupIdentification();
        $test2->iShouldGet("mu_idee,wtf");
    }
}
