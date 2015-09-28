<?php

namespace PlanckId;

use PlanckId\FloArrayPortTest;
use PlanckId\ExtractionTest;
use PlanckId\ExtractStyleTest;
use PlanckId\ExtractMarkupTest;
use PlanckId\OriginalsToPlanckTest;
use PlanckId\ExtractAndMinifyFromFileTest;
use PlanckId\ReplaceTest;

require_once 'bootstrap.php';

if (isset($_GET['debug']))
    enableDebugging();

$floArrayPortTest = new FloArrayPortTest();
$floArrayPortTest->testArrayPortOut();

$extractionTest = new ExtractionTest();
$extractionTest->testExtractingStyleSelectorOriginals();
$extractionTest->testOnlyExtract();
$extractionTest->testExtractUsingExistingMap();
$extractionTest->testExtractNewUsingExistingMap();

$extractStyleTest = new ExtractStyleTest();
$extractStyleTest->testStyleClassesExtraction();
$extractStyleTest->testStyleIdentitiesExtraction();
$extractStyleTest->testStyleBlocksStyleExtraction();

$extractMarkupTest = new ExtractMarkupTest();
$extractMarkupTest->testMarkupClassExtraction();
$extractMarkupTest->testMarkupIdentitiesExtraction();
$extractMarkupTest->testMarkupIdentitiesAndClassExtraction();

$originalsToPlanckTest = new OriginalsToPlanckTest();
$originalsToPlanckTest->testSingle();
$originalsToPlanckTest->testMultiple();

$extractAndMinifyFromFileTest = new ExtractAndMinifyFromFileTest();
$extractAndMinifyFromFileTest->testExtractAndMinifyFromFile();

$replaceTest = new ReplaceTest();
$replaceTest->testReplacingUsingExistingMap();
