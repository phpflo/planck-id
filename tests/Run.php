<?php

require_once 'bootstrap.php';

require_once 'FloArrayPortTest.php';
use PlanckId\FloArrayPortTest;

$test0 = new FloArrayPortTest();
$test0->testArrayPortOut();

$test1 = new FeatureContext([]);
$test1->iHaveContent('<a href="sdfsf" id="mu_idee" class="eh">link</a><p id="wtf"></p>');
$test1->iExtractMarkupClasses();
$test1->iShouldGet("eh");
$test1->assertOutput();

$test2 = new FeatureContext([]);
$test2->iHaveContent('<a href="sdfsf" id="mu_idee" class="eh">link</a><p id="wtf"></p>');
$test2->iExtractMarkupIdentification();
$test2->iShouldGet("mu_idee,wtf");
$test2->assertOutput();

$test3 = new FeatureContext([]);
$test3->iHaveContent("element.selector#idee[attr='eh']");
$test3->iExtractStyleClasses();
$test3->iShouldGet("selector");
$test3->assertOutput();

$test4 = new FeatureContext([]);
$test4->iHaveContent("element.selector#idee[attr='eh']");
$test4->iExtractStyleIdentities();
$test4->iShouldGet("idee");
$test4->assertOutput();

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
$test5->assertOutput();

$test6 = new FeatureContext([]);
$test6->iHaveAFileNamed(__DIR__.'/files/scenario-input.html');
$test6->iHaveInputFromFile(__DIR__.'/files/scenario-input.html');
$test6->thatGoesIntoAFileNamed(__DIR__.'/files/scenario-input.html');
$test6->iExtractAndMinify();
$test6->iWriteOutputToAFileNamed(__DIR__.'/files/scenario-output.html');
$test6->iShouldGetTheSameOutputAsTheContentsOfTheFile(__DIR__.'/files/scenario-output.html');
$test6->assertOutput();

$test7 = new FeatureContext([]);
$test7->iHaveContent('#idee');
$test7->iTurnOriginalIntoPlanck();
$test7->iShouldGet('a');
$test7->assertOutput();

$test8 = new FeatureContext([]);
$test8->iHaveContent('#idee,.classy,identifier');
$test8->iTurnOriginalsIntoPlancks();
$test8->iShouldGet('a,b,c');
$test8->assertOutput();

$test9 = new FeatureContext([]);
$test9->iHaveContent("element.classOriginal#idee[attr='eh']");
$test9->iExtractOriginalsWithoutContext();
$test9->iShouldGet('classOriginal,idee');
$test9->assertOutput();


####################################

$test10 = new FeatureContext([]);
$test10->iHaveContent('
  <style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {
  text-shadow:0 1px 0 rgba(22, 24, 29, 0.5);
  }</style><style type="text/css" scoped="scoped">@media (max-width: 399px) {
  #post-simple-media-adjacent-left-8-media {}}
  @media (min-width: 400px) and (max-width: 589px) {#post-simple-media-adjacent-left-8-media {}}@media (min-width: 590px) {#post-simple-media-adjacent-left-8-media {}<section id="section-acebf433-a6ec-43f6-8166-55c8d129353a" class="post-simple media-adjacent left else" style="background-color:rgb(45, 49, 57); position:relative"><style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a { </style>
');
$test10->onlyExtract();
$test10->assertOutput();




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
