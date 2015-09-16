<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use PlanckId\Planck\OriginalAndPlanckMap;
use PlanckId\Planck\Plancks;
use PlanckId\Emitter;
use PlanckId\Flo\ExtendedFloGraph;

#should do in the .yml
require_once __DIR__.'/../../../../bootstrap.php';

trait FeatureContents {
    /** @Given /^I have contents:$/ */
    public function iHaveContents(PyStringNode $content) {
        $this->content = $content;
        return $this;
    }
    /** @Given /^I have content "([^"]*)"$/ */
    public function iHaveContent($content) {
        $this->content = $content;        
        return $this;
    }
    /** @When /^I put that into a file named "([^"]*)"$/ */
    public function thatGoesIntoAFileNamed($fileName) {
        $this->testFileName = $fileName;
        $fileHandler = fopen($this->testFileName, 'w+');
        fwrite($fileHandler, $this->content);
        fclose($fileHandler);       
        return $this;
    }

    /** @Then /^I should get "([^"]*)"$/ */
    public function iShouldGet($string) {
        if ((string) $string !== (string) $this->output) 
            throw new Exception("Actual output is:\n" . $this->output);        
        return $this;
    } 
    /** @Then /^I should gets:$/*/
    public function iShouldGets(PyStringNode $string) {
        if ((string) $string !== $this->output) 
            throw new Exception("Actual output is:\n" . $this->output);
        return $this;
    } 
}
trait FeatureFile {
    /** @Given /^I have input from file "([^"]*)"$/ */
    public function iHaveInputFromFile($fileName) {
        $this->content = file_get_contents($fileName);
    }    
    /** @Then /^I should get the same output as the contents of the file "([^"]*)"$/ */
    public function iShouldGetTheSameOutputAsTheContentsOfTheFile($fileName) {
        $output = file_get_contents($fileName);

        lineOut(__METHOD__);
        lineOut($output);
        lineOut($this->output);
        if ((string) $output !== (string) $this->output) 
            throw new Exception("Actual output is:\n" . $this->output);
    }   
    /** @Given /^I am in a directory "([^"]*)"$/ */
    public function iAmInADirectory($dir) {
        if (!file_exists($dir)) 
            mkdir($dir);
        chdir($dir);
    }

    /** @Given /^I have a file named "([^"]*)"$/ */
    public function iHaveAFileNamed($file) {
        #touch($file);
    }
    
    /** @When /^I write output to a file named "([^"]*)"$/ */
    public function iWriteOutputToAFileNamed($file) {
        $handle = fopen($file, "w+");
        fwrite($handle, $this->output);
    }
}

trait FeatureSelectors {
    /** @When /^I extract originals$/ */
    public function iExtractOriginals() {
        $this->graph->addEdges(array(    
            ["OriginalsToPlancks", "out", "OutputOriginalForTesting", "in"], 
            ### 
              ["ReadRepeater", "style", "Style", "in"],
              ["ReadRepeater", "markup", "Markup", "in"],
              ["ReadRepeater", "contentout", "EmptyOutputForTesting", "in"],

            #Markup
                ["Markup", "identities", "MarkupIdentitiesRegex", "in"],
                  ["MarkupIdentitiesRegex", "out", "AddOriginals", "in"],
                ["Markup", "classes", "MarkupClassesRegex", "in"],
                    ["MarkupClassesRegex", "out", "MarkupClassesFromMatchedRegex", "in"],
                      ["MarkupClassesFromMatchedRegex", "out", "AddOriginals", "in"],

            #Style 
                ["Style", "styleblocks", "StyleBlocksRegex_Match", "in"],
                    ["StyleBlocksRegex_Match", "out", "StyleRegexRepeater", "styleblocks"],
                ["Style", "inlinestyles", "InlineStylesRegex_Match", "in"],
                    ["InlineStylesRegex_Match", "out", "StyleRegexRepeater", "inlinestyles"],

                #    
                ["StyleRegexRepeater", "identities", "StyleIdentitiesRegex_Match", "in"],
                  ["StyleIdentitiesRegex_Match", "out", "AddOriginals", "in"],        
                ["StyleRegexRepeater", "classes", "StyleClassesRegex_Match", "in"],
                  ["StyleClassesRegex_Match", "out", "AddOriginals", "in"],
        ));           
        
        $this->setIdentitesAsOutput();         
        $this->graph->addInitial($this->content, "ReadRepeater", "in");
    }

    /** @When /^I extract originals without context$/ */
    public function iExtractOriginalsWithoutContext() {
        $this->graph->addEdges(array(    
            ### 
              ["ReadRepeater", "style", "Style", "in"],
              ["ReadRepeater", "markup", "Markup", "in"],
              ["ReadRepeater", "contentout", "EmptyOutputForTesting", "in"],

            #Markup
                ["Markup", "identities", "MarkupIdentitiesRegex", "in"],
                  ["MarkupIdentitiesRegex", "out", "AddOriginals", "in"],
                ["Markup", "classes", "MarkupClassesRegex", "in"],
                    ["MarkupClassesRegex", "out", "MarkupClassesFromMatchedRegex", "in"],
                      ["MarkupClassesFromMatchedRegex", "out", "AddOriginals", "in"],

            #Style 
                ["Style", "styleblocks", "StyleRegexRepeater", "styleblocks"],

                ["StyleRegexRepeater", "identities", "StyleIdentitiesRegex_Match", "in"],
                  ["StyleIdentitiesRegex_Match", "out", "AddOriginals", "in"],        
                ["StyleRegexRepeater", "classes", "StyleClassesRegex_Match", "in"],
                  ["StyleClassesRegex_Match", "out", "AddOriginals", "in"],
        ));          
        
        $this->setIdentitesAsOutput();         
        $this->graph->addInitial($this->content, "ReadRepeater", "in");
    }
}

trait FeatureScriptExtract {}

trait FeatureStyleExtract {
    /** @When /^I extract style classes$/ */
    public function iExtractStyleClasses() {
        $this->graph->addEdges(array(    
            ### 
                  # this goes through some steps defined in ::setUp, and then goes to OriginalsToPlancks
                  ["StyleClassesRegex_Match", "out", "AddOriginals", "in"], 
            ### 
            ["OriginalsToPlancks", "out", "OutputOriginalForTesting", "in"],
        ));           
        
        $this->setIdentitesAsOutput();
        $this->graph->addInitial($this->content, "StyleClassesRegex_Match", "in");
    }
    /** @When /^I extract style identities$/ */
    public function iExtractStyleIdentities() {
        $this->graph->addEdges(array(    
            ### 
                  # this goes through some steps defined in ::setUp, and then goes to OriginalsToPlancks
                  ["StyleIdentitiesRegex_Match", "out", "AddOriginals", "in"], 
            ### 
            ["OriginalsToPlancks", "out", "OutputOriginalForTesting", "in"],
        ));           
            
        $this->setIdentitesAsOutput();
        $this->graph->addInitial($this->content, "StyleIdentitiesRegex_Match", "in");
    }    
    /** @When /^I extract selectors from style blocks$/ */
    public function iExtractSelectorsFromStyleBlocks() {
        $this->graph->addEdges(array(    
            ### 
            ["OriginalsToPlancks", "out", "OutputOriginalForTesting", "in"],
            ### 
                ["Style", "styleblocks", "StyleBlocksRegex_Match", "in"],
                    ["StyleBlocksRegex_Match", "out", "StyleRegexRepeater", "styleblocks"],

                ["Style", "inlinestyles", "InlineStylesRegex_Match", "in"],
                    ["InlineStylesRegex_Match", "out", "StyleRegexRepeater", "inlinestyles"],

                ##
                ["StyleRegexRepeater", "identities", "StyleIdentitiesRegex_Match", "in"],
                  ["StyleIdentitiesRegex_Match", "out", "AddOriginals", "in"],        

                ["StyleRegexRepeater", "classes", "StyleClassesRegex_Match", "in"],
                  ["StyleClassesRegex_Match", "out", "AddOriginals", "in"],
        ));           
        
        $this->setIdentitesAsOutput();
        $this->graph->addInitial($this->content, "Style", "in");
    }
}

trait FeatureOriginalToPlanck { 
     
    /** @When /^I turn original into planck$/ */
    public function iTurnOriginalIntoPlanck() {
        $this->graph->addEdges(array(    
            ["StringToArray", "out", "AddOriginals", "in"],
            ["OriginalsToPlancks", "out", "TestingOutput", "in"], 
        ));           
        $this->setIdentitesAsOutput();
        $this->graph->addInitial($this->content, "StringToArray", "in");
    }
    # same as iTurnOriginalIntoPlanck, but cannot pass an array in easily with Behat
    /** @When /^I turn originals into plancks$/ */
    public function iTurnOriginalsIntoPlancks() {
        $this->graph->addEdges(array(    
            ["StringToArray", "out", "AddOriginals", "in"],
            ["OriginalsToPlancks", "out", "TestingOutput", "in"], 
        ));           
        
        $this->setIdentitesAsOutput();
        $this->graph->addInitial($this->content, "StringToArray", "in");
    }
}

trait FeatureExtractAndMinify {
    /** @When /^I extract and minify$/ */
    public function iExtractAndMinify() {
        $this->graph->addEdges(array(    
              ["ReadRepeater", "style", "Style", "in"],
              ["ReadRepeater", "markup", "Markup", "in"],
              ["ReadRepeater", "contentout", "FloReplace", "content"],

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


            ["OriginalsToPlancks", "out", "FloReplace", "identities"],
            ##################################################### Replace
              ["FloReplace", "contentout1", "ReplaceMarkupIdentities", "content"],
              ["FloReplace", "identitiesout1", "ReplaceMarkupIdentities", "identities"], ##################
                ["ReplaceMarkupIdentities", "out", "DisplayOutputForTesting", "in"],

              ["FloReplace", "contentout2", "ReplaceMarkupClasses", "content"],
              ["FloReplace", "identitiesout2", "ReplaceMarkupClasses", "identities"],
                ["ReplaceMarkupClasses", "out", "DisplayOutputForTesting", "in"],
            ###
              
            #ReplaceStyleBlockStyles<Replace>
            ["FloReplace", "identitiesout3", "ReplaceStyleSelectors", "identities"],
            ["FloReplace", "contentout3", "ReplaceStyleBlockStyles", "in"],
              # ["StyleBlocksRegex", "out", "ReplaceStyleBlockStyles", "in"],
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
            ["FloReplace", "identitiesout4", "ReplaceJavaScript", "identities"],
            ### [ ] should use a new JavaScriptRegex_Replace
            ["FloReplace", "contentout4", "ReplaceJavaScriptBlocks", "in"],

                #ReadContentForJavaScriptBlocks<ReadContent>
                ["ReplaceJavaScriptBlocks", "content", "ReadContent_ForJavaScriptBlocks", "in"],
                  ["ReadContent_ForJavaScriptBlocks", "out", "ReplaceJavaScript", "content"],

                ["ReplaceJavaScriptBlocks", "regex", "JavaScriptRegex_Replace", "in"],
                ["JavaScriptRegex_Replace", "out", "ReplaceJavaScript", "match"],
              
                # ["ReplaceJavaScript", "out", "ReadContent", "in"], 
                # ["ReadContent", "out", "TestingOutput", "in"], 
                ["ReplaceJavaScript", "out", "DisplayOutputForTesting", "in"], 

                #Final Step
                ["ReplaceJavaScriptBlocks", "out", "TestingOutput", "in"], 
        ));
        
        lineOut(__METHOD__);
        $this->setContentAsOutput();      
        $this->graph->addInitial($this->content, "ReadRepeater", "in");
    }
}

trait FeatureMarkupExtract {
    /** @When /^I extract markup identification$/ */
    public function iExtractMarkupIdentification() {
        $this->graph->addEdges(array(    
            ["Markup", "classes", "EmptyOutputForTesting", "in"],
            ### 
            ["Markup", "identities", "MarkupIdentitiesRegex", "in"],
                ["MarkupIdentitiesRegex", "out", "AddOriginals", "in"],
        ));        
        $this->setIdentitesAsOutput();
        $this->graph->addInitial($this->content, "Markup", "in");
    }

    /** */
    public function initial() {
        $this->graph->addEdge("Read File", "out", "EmptyOutputForTesting", "in");
    }
    /** @When /^I extract markup classes$/ */
    public function iExtractMarkupClasses() {
        $this->graph->addEdges(array(    
            ["Markup", "identities", "EmptyOutputForTesting", "in"],
            ###
            ["Markup", "classes", "MarkupClassesRegex", "in"],
                ["MarkupClassesRegex", "out", "MarkupClassesFromMatchedRegex", "in"],
                    ["MarkupClassesFromMatchedRegex", "out", "AddOriginals", "in"],
        ));        
        $this->setIdentitesAsOutput();
        $this->graph->addInitial($this->content, "Markup", "in");
    }

    /** @When /^I extract markup classes and identities$/ */
    public function iExtractMarkupClassesAndIdentities() {
         $this->graph->addEdges(array(    
            ["Markup", "identities", "MarkupIdentitiesRegex", "in"],
              ["MarkupIdentitiesRegex", "out", "AddOriginals", "in"],

            ["Markup", "classes", "MarkupClassesRegex", "in"],
              ["MarkupClassesRegex", "out", "MarkupClassesFromMatchedRegex", "in"],
                ["MarkupClassesFromMatchedRegex", "out", "AddOriginals", "in"],
        ));
        $this->setIdentitesAsOutput();
        $this->graph->addInitial($this->content, "Markup", "in");
    }

    public function assertOutput() {
        lineOut($this->output);
    }
}
trait SetUpGraph {
    public function setUpGraph() {
        $this->graph = new ExtendedFloGraph("identity");
        $this->graph->addNode("Read File",                      "ReadFile");

        $this->graph->addNode("MarkupClassesRegex",             "PlanckId\Regex\MarkupClassesRegex");
        $this->graph->addNode("MarkupIdentitiesRegex",          "PlanckId\Regex\MarkupIdentitiesRegex");
        $this->graph->addNode("MarkupClassesFromMatchedRegex",  "PlanckId\Regex\MarkupClassesFromMatchedRegex");

        $this->graph->addNode("StyleBlocksRegex_Replace",       "PlanckId\Regex\StyleBlocksRegex");
        $this->graph->addNode("StyleBlocksRegex_Match",         "PlanckId\Regex\StyleBlocksRegex");
        $this->graph->addNode("InlineStylesRegex_Replace",      "PlanckId\Regex\InlineStylesRegex");
        $this->graph->addNode("InlineStylesRegex_Match",        "PlanckId\Regex\InlineStylesRegex");

        $this->graph->addNode("StyleIdentitiesRegex",           "PlanckId\Regex\StyleIdentitiesRegex");
        $this->graph->addNode("StyleIdentitiesRegex_Match",     "PlanckId\Regex\StyleIdentitiesRegex");
        $this->graph->addNode("StyleClassesRegex_Match",        "PlanckId\Regex\StyleClassesRegex");
        $this->graph->addNode("StyleClassesRegex",              "PlanckId\Regex\StyleClassesRegex");
        $this->graph->addNode("JavaScriptRegex_Match",          "PlanckId\Regex\JavaScriptRegex");
        $this->graph->addNode("JavaScriptRegex_Replace",        "PlanckId\Regex\JavaScriptRegex");

        $this->graph->addNode("Style",                          "PlanckId\Replace\FloStyle");
        $this->graph->addNode("StyleRegexRepeater",             "PlanckId\StyleRegexRepeater");
        $this->graph->addNode("Markup",                         "PlanckId\FloMarkup");
        $this->graph->addNode("AddOriginals",                   "PlanckId\Originals\AddOriginals");
        $this->graph->addNode("OriginalsToPlancks",             "PlanckId\Originals\OriginalsToPlancks");

        $this->graph->addNode("RemoveUselessOriginals",        "PlanckId\Originals\RemoveUselessOriginals");
        $this->graph->addNode("SortOriginalsByLength",         "PlanckId\Originals\SortOriginalsByLength");

        $this->graph->addNode("FloReplace",                     "PlanckId\Replace\FloReplace");
        $this->graph->addNode("ReplaceStyleSelectors",          "PlanckId\Replace\ReplaceStyleSelectors");
        $this->graph->addNode("ReplaceMarkupIdentities",        "PlanckId\Replace\ReplaceMarkupIdentities");
        $this->graph->addNode("ReplaceMarkupClasses",           "PlanckId\Replace\ReplaceMarkupClasses");
        $this->graph->addNode("ReplaceJavaScript",              "PlanckId\Replace\ReplaceJavaScript");

        $this->graph->addNode("FlattenAndUniqueArray",          "PlanckId\Utilities\FlattenAndUniqueArray");
        $this->graph->addNode("ReadRepeater",                   "PlanckId\ReadRepeater");
        $this->graph->addNode("ReadRepeaterFinal",              "PlanckId\ReadRepeaterFinal");

        $this->graph->addNode("WriteReadRepeaterContent",       "PlanckId\Content\WriteContent");
        $this->graph->addNode("OutputToFile",                   "PlanckId\Output\OutputToFile");
        $this->graph->addNode("DisplayOutputForTesting",        "PlanckId\Output\DisplayOutputForTesting");
        $this->graph->addNode("EmptyOutputForTesting",          "PlanckId\Output\EmptyOutputForTesting");
        $this->graph->addNode("Display",                        "Output");

        $this->graph->addNode("ReadContent_ForStyleBlocks",     "PlanckId\Content\ReadContent");
        $this->graph->addNode("ReadContent_ForJavaScriptBlocks","PlanckId\Content\ReadContent");
        $this->graph->addNode("ReadContent",                    "PlanckId\Content\ReadContent");
        $this->graph->addNode("WriteContent",                   "PlanckId\Content\WriteContent");

        $this->graph->addNode("StyleBlocksRegex_Replace",       "PlanckId\Regex\StyleBlocksRegex");
        $this->graph->addNode("ReplaceStyleBlockStyles",        "PlanckId\Replace\Replace");
        $this->graph->addNode("ReplaceJavaScriptBlocks",        "PlanckId\Replace\Replace");

        $this->graph->addNode("TestingOutput",                  "PlanckId\Output\TestingContentOutput");
        $this->graph->addNode("OutputOriginalForTesting",       "PlanckId\Output\OutputOriginalForTesting");
        $this->graph->addNode("StringToArray",                  "PlanckId\Utilities\StringToArray");
        $this->graph->addNode("ArrayToString",                  "PlanckId\Utilities\ArrayToString");
        
        $this->setGraphEdgeToMinify();

        lineOut($this->graph->toJSON());

        // $network 
        // Make the graph "live"
        PhpFlo\Network::create($this->graph);
    }

    public function setContentAsOutput() {
    }

    public function setMinifiedAsOutput() {
        $this->graph->addEdges(array(    
            ["OriginalsToPlancks", "out", "ArrayToString", "in"],
            ["ArrayToString", "out", "TestingOutput", "in"],
        ));
    }

    public function setIdentitesAsOutput() {
        $this->graph->addEdges(array(    
            ["OriginalsToPlancks", "out", "OutputOriginalForTesting", "in"],
        ));
    }

    public function setGraphEdgeToMinify() {
        $this->graph->addEdges(array(    
            ["AddOriginals", "out", "RemoveUselessOriginals", "in"],
            ["RemoveUselessOriginals", "out", "SortOriginalsByLength", "in"],            
            ["SortOriginalsByLength", "out", "OriginalsToPlancks", "in"],
        ));
    }
}

/**
 * Features context.
 * 
 * [ ] or... preferably... use events to change the state of the test
 * [ ] may need $this for non PHP7
 */
class FeatureContext extends BehatContext
{
    use FeatureContents;
    use FeatureSelectors;
    use FeatureMarkupExtract;
    use FeatureScriptExtract;
    use FeatureStyleExtract;
    use FeatureFile;
    use FeatureOriginalToPlanck;
    use FeatureExtractAndMinify;
    use SetUpGraph;

    public $content;
    public $output;
    public $testFileName = "";
    public $graph;

    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $params context params (behat.yml)
     */
    public function __construct(array $params) {
        OriginalAndPlanckMap::reset();
        Plancks::reset();

        $me = $this;
        Emitter::addListener('testing.output', function ($event, $param = null) use ($me) {
            $me->output = $param;
        });

        $this->setUpGraph();
        echo "\n<hr>___________________________________________________________________________";
    }
}
