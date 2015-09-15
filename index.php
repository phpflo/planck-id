<?php

use PlanckId\Flo\ExtendedFloGraph;

require_once 'bootstrap.php';

if (isset($_SERVER['argv'][1])) 
    $fileName = $_SERVER['argv'][1];
elseif (isset($_REQUEST['filename']))
    $fileName = $_REQUEST['filename'];
elseif (isset($_REQUEST['content']))
    $content = $_REQUEST['content'];
elseif (!isset($_REQUEST['content']) && !isset($_SERVER['argv'][1]) && !isset($_REQUEST['filename'])) 
    throw new \Exception('content and filename were not passed in, command line argument was not passed in.');

if (isset($_SERVER['argv'][2]) || isset($_REQUEST['debug']))
    define('DEBUGGING_PLANCK', true);

$graph = new ExtendedFloGraph("planck");
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

$graph->addNode("RemoveUselessOriginals",        "PlanckId\Originals\RemoveUselessOriginals");
$graph->addNode("SortOriginalsByLength",         "PlanckId\Originals\SortOriginalsByLength");

$graph->addNode("FloReplaceFinal",                "PlanckId\Replace\FloReplaceFinal");
$graph->addNode("FloReplace",                     "PlanckId\Replace\FloReplace");
$graph->addNode("ReplaceStyleSelectors",          "PlanckId\Replace\ReplaceStyleSelectors");
$graph->addNode("ReplaceMarkupIdentities",        "PlanckId\Replace\ReplaceMarkupIdentities");
$graph->addNode("ReplaceMarkupClasses",           "PlanckId\Replace\ReplaceMarkupClasses");
$graph->addNode("ReplaceJavaScript",              "PlanckId\Replace\ReplaceJavaScript");

$graph->addNode("FlattenAndUniqueArray",          "PlanckId\Utilities\FlattenAndUniqueArray");
$graph->addNode("ReadRepeater",                   "PlanckId\ReadRepeater");
$graph->addNode("ReadRepeaterFinal",              "PlanckId\ReadRepeaterFinal");

$graph->addNode("WriteReadRepeaterContent",       "PlanckId\Content\WriteContent");
$graph->addNode("OutputToFile",                   "PlanckId\Output\OutputToFile");
$graph->addNode("DisplayOutputForTesting",        "PlanckId\Output\DisplayOutputForTesting");
$graph->addNode("EmptyOutputForTesting",          "PlanckId\Output\EmptyOutputForTesting");
$graph->addNode("Display",                        "Output");

$graph->addNode("ReadContent_ForStyleBlocks",     "PlanckId\Content\ReadContent");
$graph->addNode("ReadContent_ForJavaScriptBlocks","PlanckId\Content\ReadContent");
$graph->addNode("ReadContent_ForFinalOutput",     "PlanckId\Content\ReadContent");
$graph->addNode("ReadContent",                    "PlanckId\Content\ReadContent");
$graph->addNode("WriteContent",                   "PlanckId\Content\WriteContent");

$graph->addNode("StyleBlocksRegex_Replace",       "PlanckId\Regex\StyleBlocksRegex");
$graph->addNode("ReplaceStyleBlockStyles",        "PlanckId\Replace\Replace");
$graph->addNode("ReplaceJavaScriptBlocks",        "PlanckId\Replace\Replace");

$graph->addNode("TestingOutput",                  "PlanckId\Output\TestingContentOutput");
$graph->addNode("OutputOriginalForTesting",       "PlanckId\Output\OutputOriginalForTesting");
$graph->addNode("StringToArray",                  "PlanckId\Utilities\StringToArray");
$graph->addNode("ArrayToString",                  "PlanckId\Utilities\ArrayToString");

$graph->addNode("OutputFinal",                    "PlanckId\Output\OutputFinal");

$graph->addEdges(array(    

##################################################### SETUP
["AddOriginals", "out", "RemoveUselessOriginals", "in"],
["RemoveUselessOriginals", "out", "SortOriginalsByLength", "in"],            
["SortOriginalsByLength", "out", "OriginalsToPlancks", "in"],

##################################################### REPEAT FILE TO EXTRACT & REPLACE
  ["ReadRepeater", "style", "Style", "in"],
  ["ReadRepeater", "markup", "Markup", "in"],
  ["ReadRepeater", "contentout", "FloReplaceFinal", "content"],
  
  ["ReadRepeater", "final", "ReadContent_ForFinalOutput", "in"],
  ["ReadContent_ForFinalOutput", "out", "OutputFinal", "planckedcontent"],

  ["FloReplaceFinal", "identitiesout0", "OutputFinal", "map"],
##################################################### EXTRACT
#Markup
    ["Markup", "identities", "MarkupIdentitiesRegex", "in"],
      ["MarkupIdentitiesRegex", "out", "AddOriginals", "in"],

    ["Markup", "classes", "MarkupClassesRegex", "in"],
        ["MarkupClassesRegex", "out", "MarkupClassesFromMatchedRegex", "in"],
          ["MarkupClassesFromMatchedRegex", "out", "AddOriginals", "in"],

#Style 
    ["Style", "styleblocks", "StyleBlocksRegex_Match", "in"],
        ["StyleBlocksRegex_Match", "out", "StyleRegexRepeater", "styleblocks"],

    #    
    ["StyleRegexRepeater", "identities", "StyleIdentitiesRegex_Match", "in"],
      ["StyleIdentitiesRegex_Match", "out", "AddOriginals", "in"],        

    ["StyleRegexRepeater", "classes", "StyleClassesRegex_Match", "in"],
      ["StyleClassesRegex_Match", "out", "AddOriginals", "in"],


["OriginalsToPlancks", "out", "FloReplaceFinal", "identities"],
##################################################### Replace
  ["FloReplaceFinal", "contentout1", "ReplaceMarkupIdentities", "content"],
  ["FloReplaceFinal", "identitiesout1", "ReplaceMarkupIdentities", "identities"], ##################
    ["ReplaceMarkupIdentities", "out", "DisplayOutputForTesting", "in"],

  ["FloReplaceFinal", "contentout2", "ReplaceMarkupClasses", "content"],
  ["FloReplaceFinal", "identitiesout2", "ReplaceMarkupClasses", "identities"],
    ["ReplaceMarkupClasses", "out", "DisplayOutputForTesting", "in"],
###
  
#ReplaceStyleBlockStyles<Replace>
["FloReplaceFinal", "identitiesout3", "ReplaceStyleSelectors", "identities"],
["FloReplaceFinal", "contentout3", "ReplaceStyleBlockStyles", "in"],
    ["ReplaceStyleBlockStyles", "out", "DisplayOutputForTesting", "in"], # idk why?

    ["ReplaceStyleBlockStyles", "regex", "StyleBlocksRegex_Replace", "in"],
      ["StyleBlocksRegex_Replace", "out", "ReplaceStyleSelectors", "match"],

    #ReadContentForStyleBlocks<ReadContent>
    ["ReplaceStyleBlockStyles", "content", "ReadContent_ForStyleBlocks", "in"],
      ["ReadContent_ForStyleBlocks", "out", "ReplaceStyleSelectors", "content"],
        // ["ReplaceStyleSelectors<ReadContent>", "writecontent", "WriteContent", "in"] // could do later if needed
    ["ReplaceStyleSelectors", "out", "DisplayOutputForTesting", "in"],

# does the real replacing
## ReplaceJavaScript 
# in an instanceof Replace, forwarding
## ReplaceJavaScriptBlocks 
# in an instanceof ReadContent
## ReadContentForJavaScriptBlocks 
# in an instanceof Regex for JS
## JavaScriptRegex 
["FloReplaceFinal", "identitiesout4", "ReplaceJavaScript", "identities"],
### [ ] should use a new JavaScriptRegex_Replace
["FloReplaceFinal", "contentout4", "ReplaceJavaScriptBlocks", "in"],

    #ReadContentForJavaScriptBlocks<ReadContent>
    ["ReplaceJavaScriptBlocks", "content", "ReadContent_ForJavaScriptBlocks", "in"],
      ["ReadContent_ForJavaScriptBlocks", "out", "ReplaceJavaScript", "content"],

    ["ReplaceJavaScriptBlocks", "regex", "JavaScriptRegex_Replace", "in"],
    ["JavaScriptRegex_Replace", "out", "ReplaceJavaScript", "match"],
  
    # ["ReplaceJavaScript", "out", "ReadContent", "in"], 
    # ["ReadContent", "out", "TestingOutput", "in"], 
    ["ReplaceJavaScript", "out", "DisplayOutputForTesting", "in"], 

    #Final Step
    ["ReplaceJavaScriptBlocks", "out", "DisplayOutputForTesting", "in"], 
));
if ($content)
    $graph->addInitial($content, "ReadRepeater", "in");

elseif ($fileName) {
    $graph->addEdge("Read File", "out", "ReadRepeater", "in");
    $graph->addInitial($fileName, "Read File", "source");
}


// Make the graph "live"
$network = PhpFlo\Network::create($graph);