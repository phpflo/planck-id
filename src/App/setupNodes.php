<?php

function setUpNodes($graph) {
    $graph->addNode("Read File",                      "ReadFile");

    $graph->addNode("MarkupClassesRegex",             "PlanckId\Regex\MarkupClassesRegex");
    $graph->addNode("MarkupIdentitiesRegex",          "PlanckId\Regex\MarkupIdentitiesRegex");
    $graph->addNode("MarkupClassesFromMatchedRegex",  "PlanckId\Regex\MarkupClassesFromMatchedRegex");

    $graph->addNode("StyleBlocksRegex_Replace",       "PlanckId\Regex\StyleBlocksRegex");
    $graph->addNode("StyleBlocksRegex_Match",         "PlanckId\Regex\StyleBlocksRegex");
    $graph->addNode("InlineStylesRegex_Replace",      "PlanckId\Regex\InlineStylesRegex");
    $graph->addNode("InlineStylesRegex_Match",        "PlanckId\Regex\InlineStylesRegex");

    $graph->addNode("StyleIdentitiesRegex",           "PlanckId\Regex\StyleIdentitiesRegex");
    $graph->addNode("StyleIdentitiesRegex_Match",     "PlanckId\Regex\StyleIdentitiesRegex");
    $graph->addNode("StyleClassesRegex_Match",        "PlanckId\Regex\StyleClassesRegex");
    $graph->addNode("StyleClassesRegex",              "PlanckId\Regex\StyleClassesRegex");
    $graph->addNode("JavaScriptRegex_Match",          "PlanckId\Regex\JavaScriptRegex");
    $graph->addNode("JavaScriptRegex_Replace",        "PlanckId\Regex\JavaScriptRegex");

    $graph->addNode("Style",                          "PlanckId\Replace\FloStyle");
    $graph->addNode("StyleRegexRepeater",             "PlanckId\StyleRegexRepeater");
    $graph->addNode("Markup",                         "PlanckId\FloMarkup");
    $graph->addNode("AddOriginals",                   "PlanckId\Originals\AddOriginals");
    $graph->addNode("OriginalsToPlancks",             "PlanckId\Originals\OriginalsToPlancks");

    $graph->addNode("RemoveUselessOriginals",         "PlanckId\Originals\RemoveUselessOriginals");
    $graph->addNode("SortOriginalsByLength",          "PlanckId\Originals\SortOriginalsByLength");

    $graph->addNode("ReadOriginalAndPlanckMap",       "PlanckId\Originals\ReadOriginalAndPlanckMap");
    $graph->addNode("ReadMap_ForContentAndMap",       "PlanckId\Originals\ReadOriginalAndPlanckMap");
    $graph->addNode("ReadMapDeadEnd",                 "PlanckId\Originals\ReadOriginalAndPlanckMap");

    $graph->addNode("WriteOriginalAndPlanckMap",      "PlanckId\Originals\WriteOriginalAndPlanckMap");
    $graph->addNode("WriteMap_ForContentAndMap",      "PlanckId\Originals\WriteOriginalAndPlanckMap");
    $graph->addNode("WriteMapDeadEnd",                "PlanckId\Originals\WriteOriginalAndPlanckMap");

    $graph->addNode("ExtractOriginals",               "PlanckId\Core\ExtractOriginals");
    $graph->addNode("ExtractAndReplace",              "PlanckId\Core\ExtractAndReplace");
    $graph->addNode("ContentAndMap",                  "PlanckId\Core\ContentAndMap");

    $graph->addNode("FloReplace",                     "PlanckId\Replace\FloReplace");
    $graph->addNode("ReplaceStyleSelectors",          "PlanckId\Replace\ReplaceStyleSelectors");
    $graph->addNode("ReplaceMarkupIdentities",        "PlanckId\Replace\ReplaceMarkupIdentities");
    $graph->addNode("ReplaceMarkupClasses",           "PlanckId\Replace\ReplaceMarkupClasses");
    $graph->addNode("ReplaceJavaScript",              "PlanckId\Replace\ReplaceJavaScript");

    $graph->addNode("FlattenAndUniqueArray",          "PlanckId\Utilities\FlattenAndUniqueArray");
    $graph->addNode("ReadRepeater",                   "PlanckId\ReadRepeater");

    $graph->addNode("WriteReadRepeaterContent",       "PlanckId\Content\WriteContent");
    $graph->addNode("OutputToFile",                   "PlanckId\Output\OutputToFile");
    $graph->addNode("DisplayOutputForTesting",        "PlanckId\Output\DisplayOutputForTesting");
    $graph->addNode("EmptyOutputForTesting",          "PlanckId\Output\EmptyOutputForTesting");
    $graph->addNode("OutputFinal",                    "PlanckId\Output\OutputFinal");
    $graph->addNode("Display",                        "Output");

    $graph->addNode("ReadContent_ForStyleBlocks",     "PlanckId\Content\ReadContent");
    $graph->addNode("ReadContent_ForJavaScriptBlocks","PlanckId\Content\ReadContent");
    $graph->addNode("ReadContent",                    "PlanckId\Content\ReadContent");
    $graph->addNode("WriteContent",                   "PlanckId\Content\WriteContent");
    $graph->addNode("ReadContent_ForContentAndMap",   "PlanckId\Content\ReadContent");
    $graph->addNode("WriteContent_ForContentAndMap",  "PlanckId\Content\WriteContent");
    $graph->addNode("ReadContentDeadEnd",             "PlanckId\Originals\ReadOriginalAndPlanckMap");
    $graph->addNode("WriteContentDeadEnd",            "PlanckId\Originals\ReadOriginalAndPlanckMap");

    $graph->addNode("ReplaceStyleBlockStyles",        "PlanckId\Replace\Replace");
    $graph->addNode("ReplaceJavaScriptBlocks",        "PlanckId\Replace\Replace");

    $graph->addNode("TestingOutput",                  "PlanckId\Output\TestingContentOutput");
    $graph->addNode("StringToArray",                  "PlanckId\Utilities\StringToArray");
    $graph->addNode("ArrayToString",                  "PlanckId\Utilities\ArrayToString");
    $graph->addNode("ArrayKeys",                      "PlanckId\Utilities\ArrayKeys");
    $graph->addNode("JsonEncode",                     "PlanckId\Utilities\JsonEncode");
    $graph->addNode("JsonDecode",                     "PlanckId\Utilities\JsonDecode");


    $graph->addNode("Callback_ForMap", "PlanckId\Utilities\Callback");
    $graph->addNode("Callback_ForContent", "PlanckId\Utilities\Callback");
  
    $graph->addNode("ReadExternalFile_Map", "PlanckId\Utilities\ReadExternalFile");
    $graph->addNode("ReadExternalFile_Map", "PlanckId\Utilities\ReadExternalFile");
    $graph->addNode("OutputToFile_Map", "PlanckId\Output\OutputToFile");
    $graph->addNode("OutputToFile_Content", "PlanckId\Output\OutputToFile");
    $graph->addNode("ReadOriginalAndPlanckMap_ForOutput", "PlanckId\Originals\ReadOriginalAndPlanckMap");
}
