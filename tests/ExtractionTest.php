<?php

namespace PlanckId;

use FeatureContext;

class ExtractionTest extends \PHPUnit_Framework_TestCase {

    public function onNonSuccessfulTest(\Exception $e) {
      dump($e);
    }

    public function testExtractingStyleSelectorOriginals() {
        $test9 = new FeatureContext([]);
        $test9->iHaveContent("element.classOriginal#idee[attr='eh']");
        $test9->iExtractStyleSelectorOriginals();
        $test9->iShouldGet('classOriginal,idee');
    }
    public function testOnlyExtract() {
        $test10 = new FeatureContext([]);
        $test10->iHaveContent('
          <section id="section-acebf433-a6ec-43f6-8166-55c8d129353a" class="post-simple media-adjacent left else" style="background-color:rgb(45, 49, 57); position:relative">
          <style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {
          text-shadow:0 1px 0 rgba(22, 24, 29, 0.5);
          }</style><style type="text/css" scoped="scoped">@media (max-width: 399px) {
          #post-simple-media-adjacent-left-8-media {}}
          @media (min-width: 400px) and (max-width: 589px) {#post-simple-media-adjacent-left-8-media {}}@media (min-width: 590px) {#post-simple-media-adjacent-left-8-media {}</style><style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {} </style>
          <script>if (1){} else {var test = document.getElementById("post-simple-media-adjacent-left-8-media"); $post-simple-media-adjacent-left-8-media} </script>
        ');
        $test10->onlyExtract();
        $test10->iShouldGet("section-acebf433-a6ec-43f6-8166-55c8d129353a,post-simple-media-adjacent-left-8-media,media-adjacent,post-simple,left,else");
        $test10->assertOutput();
    }
    public function testExtractUsingExistingMap() {
        $test12 = new FeatureContext([]);
        $test12->iHaveContent('
          <section id="section-acebf433-a6ec-43f6-8166-55c8d129353a" class="post-simple media-adjacent left else" style="background-color:rgb(45, 49, 57); position:relative">
          <style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {
          text-shadow:0 1px 0 rgba(22, 24, 29, 0.5);
          }</style><style type="text/css" scoped="scoped">@media (max-width: 399px) {
          #post-simple-media-adjacent-left-8-media {}}
          @media (min-width: 400px) and (max-width: 589px) {#post-simple-media-adjacent-left-8-media {}}@media (min-width: 590px) {#post-simple-media-adjacent-left-8-media {}</style><style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {} </style>
          <script>if (1){} else {var test = document.getElementById("post-simple-media-adjacent-left-8-media"); $post-simple-media-adjacent-left-8-media} </script>
        ');

        $test12->extractUsingExistingMap([
            "section-acebf433-a6ec-43f6-8166-55c8d129353a" => "a",
            "post-simple-media-adjacent-left-8-media" => "b",
            "media-adjacent" => "c",
            "post-simple" => "d",
            "left" => "e",
            "else" => "f",]);  

        $test12->iShouldGetNonStringEqualing([
            "section-acebf433-a6ec-43f6-8166-55c8d129353a" => "a",
            "post-simple-media-adjacent-left-8-media" => "b",
            "media-adjacent" => "c",
            "post-simple" => "d",
            "left" => "e",
            "else" => "f",]);

        $test12->assertOutput();
    }    

    public function testExtractNewUsingExistingMap() {
        $test13 = new FeatureContext([]);
        $test13->iHaveContent('
          <section id="section-acebf433-a6ec-43f6-8166-55c8d129353a" class="post-simple media-adjacent left else" style="background-color:rgb(45, 49, 57); position:relative">
          <style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {
          text-shadow:0 1px 0 rgba(22, 24, 29, 0.5);
          }</style><style type="text/css" scoped="scoped">@media (max-width: 399px) {
          #post-simple-media-adjacent-left-8-media {}}
          @media (min-width: 400px) and (max-width: 589px) {#post-simple-media-adjacent-left-8-media {}}@media (min-width: 590px) {#post-simple-media-adjacent-left-8-media {}</style><style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {} </style>
          <script>if (1){} else {var test = document.getElementById("post-simple-media-adjacent-left-8-media"); $post-simple-media-adjacent-left-8-media} </script>
        ');

        $test13->extractUsingExistingMap([
            "section-acebf433-a6ec-43f6-8166-55c8d129353a" => "a",
            "post-simple-media-adjacent-left-8-media" => "b",
            "media-adjacent" => "c",
            "post-simple" => "d",
            "left" => "e"]);  

        // finds `else` and adds it, starting at `f`
        $test13->iShouldGetNonStringEqualing([
            "section-acebf433-a6ec-43f6-8166-55c8d129353a" => "a",
            "post-simple-media-adjacent-left-8-media" => "b",
            "media-adjacent" => "c",
            "post-simple" => "d",
            "else" => "f",
            "left" => "e"]);

        $test13->assertOutput();
    }
}
